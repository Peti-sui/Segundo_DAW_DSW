<?php
abstract class Producto
{
    protected ?int $id = null;
    protected string $nombre;
    protected float $precio;
    protected string $tipo;
    protected string $imagen;

    public function __construct(string $nombre, float $precio, string $tipo = '', string $imagen = '')
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->imagen = $imagen;
    }

    // Getters
    public function getNombre(): string { return $this->nombre; }
    public function getPrecio(): float { return $this->precio; }
    public function getTipo(): string { return $this->tipo; }
    public function getImagen(): string { return $this->imagen; }
    public function getId(): ?int { return $this->id; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setPrecio(float $precio): void { $this->precio = $precio; }
    public function setTipo(string $tipo): void { $this->tipo = $tipo; }
    public function setImagen(string $imagen): void { $this->imagen = $imagen; }

    // Método abstracto para calcular precio según cantidad
    abstract public function calcularPrecio(int $cantidad): float;

    // Método estático para obtener conexión
    protected static function getConnection()
    {
        static $conn = null;
        
        if ($conn === null) {
            require_once __DIR__ . '/../config/db.php';
            $conn = $GLOBALS['conn'];
        }
        
        return $conn;
    }

    // Método para verificar si ya existe un producto con el mismo nombre y tipo
    public function existeMismoNombreTipo(): bool
    {
        $conn = self::getConnection();
        
        if ($this->id !== null) {
            // Para edición: excluir el producto actual
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM productos WHERE nombre = ? AND tipo = ? AND id != ?");
            $stmt->bind_param("ssi", $this->nombre, $this->tipo, $this->id);
        } else {
            // Para creación: buscar cualquier producto con mismo nombre y tipo
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM productos WHERE nombre = ? AND tipo = ?");
            $stmt->bind_param("ss", $this->nombre, $this->tipo);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['count'] > 0;
    }

    // Métodos para CRUD con validación
    public function save(): bool
    {
        // Validar que no exista producto con mismo nombre y tipo
        if ($this->existeMismoNombreTipo()) {
            throw new Exception("Ya existe un producto con el nombre '{$this->nombre}' del tipo '{$this->tipo}'");
        }
        
        $conn = self::getConnection();
        
        if ($this->id !== null) {
            $stmt = $conn->prepare("UPDATE productos SET nombre=?, precio=?, tipo=?, imagen=? WHERE id=?");
            $stmt->bind_param("sdssi", $this->nombre, $this->precio, $this->tipo, $this->imagen, $this->id);
            return $stmt->execute();
        } else {
            $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, tipo, imagen) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $this->nombre, $this->precio, $this->tipo, $this->imagen);
            $result = $stmt->execute();
            
            if ($result) {
                $this->id = $stmt->insert_id;
            }
            
            return $result;
        }
    }

    public function delete(): bool
    {
        if ($this->id === null) {
            return false;
        }
        
        $conn = self::getConnection();
        $stmt = $conn->prepare("DELETE FROM productos WHERE id=?");
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    // Método estático para buscar por ID
    public static function findById(int $id): ?Producto
    {
        $conn = self::getConnection();
        $stmt = $conn->prepare("SELECT * FROM productos WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return self::crearDesdeArray($row);
        }
        
        return null;
    }

    // Método estático para obtener todos
    public static function getAll(): array
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM productos");
        
        if (!$result) {
            return [];
        }
        
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = self::crearDesdeArray($row);
        }
        
        return $productos;
    }

    // Método estático para verificar si un nombre-tipo ya existe
    public static function nombreTipoExiste(string $nombre, string $tipo, ?int $excluirId = null): bool
    {
        $conn = self::getConnection();
        
        if ($excluirId !== null) {
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM productos WHERE nombre = ? AND tipo = ? AND id != ?");
            $stmt->bind_param("ssi", $nombre, $tipo, $excluirId);
        } else {
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM productos WHERE nombre = ? AND tipo = ?");
            $stmt->bind_param("ss", $nombre, $tipo);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['count'] > 0;
    }

    // Método PÚBLICO para crear objeto desde array
    public static function crearDesdeArray(array $data): Producto
    {
        // Validar datos mínimos
        if (!isset($data['nombre']) || !isset($data['precio'])) {
            throw new InvalidArgumentException('Los datos del producto deben incluir nombre y precio');
        }
        
        $tipo = $data['tipo'] ?? '';
        $nombre = $data['nombre'];
        $precio = floatval($data['precio']);
        $imagen = $data['imagen'] ?? '';
        $id = $data['id'] ?? null;
        
        require_once __DIR__ . '/PaqueteLlaves.php';
        require_once __DIR__ . '/PaqueteBolso.php';
        require_once __DIR__ . '/PaqueteMochila.php';
        require_once __DIR__ . '/Llavero.php';
        
        switch ($tipo) {
            case 'llaves':
                $producto = new PaqueteLlaves($nombre, $precio);
                break;
            case 'bolso':
                $producto = new PaqueteBolso($nombre, $precio);
                break;
            case 'mochila':
                $producto = new PaqueteMochila($nombre, $precio);
                break;
            default:
                $producto = new Llavero($nombre, $precio, $tipo);
        }
        
        $producto->setId($id);
        $producto->setTipo($tipo);
        $producto->setImagen($imagen);
        
        return $producto;
    }
}
?>