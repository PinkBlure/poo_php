<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  class CuentaCorriente
  {

    private string $cuenta;
    private string $nombre;
    private float $importe;

    public function __construct(string $cuenta, string $nombre, float $importe)
    {
      $this->cuenta = $cuenta;
      $this->nombre = $nombre;
      $this->importe = $importe;
    }

    public function ingresarDinero(float $cantidad): void
    {
      if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad a ingresar debe ser mayor que 0");
      }
      $this->importe += $cantidad;
    }

    public function retirarDinero(float $cantidad): void
    {
      if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad a retirar debe ser mayor que 0");
      } elseif ($cantidad > $this->importe) {
        throw new InvalidArgumentException("La cantidad a retirar debe ser menor o igual que la cantidad que tengas en el banco");
      }
      $this->importe += $cantidad;
    }

    public function transferirDinero(CuentaCorriente $cuenta, float $cantidad)
    {
      if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad a transferir debe ser mayor que 0");
      } elseif ($cantidad > $this->importe) {
        throw new InvalidArgumentException("La cantidad a transferir debe ser menor o igual que la cantidad que tengas en el banco");
      }
      $this->retirarDinero($cantidad);
      $cuenta->ingresarDinero($cantidad);
    }

    public function consultarSaldo(): float
    {
      return $this->importe;
    }
  }

  try {
    $cuenta1 = new CuentaCorriente("123456", "Aileen", 1000.0);
    $cuenta2 = new CuentaCorriente("654321", "Kevin", 500.0);

    echo "Saldo inicial de cuenta1: " . $cuenta1->consultarSaldo() . "€\n";
    echo "Saldo inicial de cuenta2: " . $cuenta2->consultarSaldo() . "€\n";

    $cuenta1->ingresarDinero(200.0);
    echo "Saldo de cuenta1 tras ingresar 200€: " . $cuenta1->consultarSaldo() . "€\n";

    $cuenta2->retirarDinero(100.0);
    echo "Saldo de cuenta2 tras retirar 100€: " . $cuenta2->consultarSaldo() . "€\n";

    $cuenta1->transferirDinero($cuenta2, 300.0);
    echo "Saldo de cuenta1 tras transferir 300€ a cuenta2: " . $cuenta1->consultarSaldo() . "€\n";
    echo "Saldo de cuenta2 tras recibir 300€ de cuenta1: " . $cuenta2->consultarSaldo() . "€\n";

    $cuenta1->ingresarDinero(-50.0);
  } catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
  }

  class Electrodomestico
  {
    private float $precioBase;
    private String $color;
    private String $letra;
    private float $peso;

    private const COLORES_PERMITIDOS = ["blanco", "negro", "rojo", "azul", "gris"];
    private const LETRAS_PERMITIDAS = ["A", "B", "C", "D", "E", "F"];

    public function __construct(float $precioBase = 100, string $color = "blanco", string $letra = "F", int $peso = 5)
    {
      $this->precioBase = $precioBase;
      $this->color = $this->comprobarColor($color);
      $this->letra = $this->comprobarLetra($letra);
      $this->peso = $peso;
    }

    public function getPrecioBase(): float
    {
      return $this->precioBase;
    }

    public function getColor(): string
    {
      return $this->color;
    }

    public function getLetra(): string
    {
      return $this->letra;
    }

    public function getPeso(): int
    {
      return $this->peso;
    }

    private function comprobarLetra(string $letra): string
    {
      if (in_array(strtoupper($letra), self::LETRAS_PERMITIDAS)) {
        return strtoupper($letra);
      }
      return "F";
    }

    private function comprobarColor(string $color): string
    {
      if (in_array(strtolower($color), self::COLORES_PERMITIDOS)) {
        return strtolower($color);
      }
      return "blanco";
    }

    
  }
  ?>

</body>

</html>
