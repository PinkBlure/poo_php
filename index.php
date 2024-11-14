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

    public function __construct(string $cuenta = "", string $nombre = "", float $importe = 0.0)
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
      $this->importe -= $cantidad;
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

    echo "Saldo inicial de cuenta1: " . $cuenta1->consultarSaldo() . "€<br>";
    echo "Saldo inicial de cuenta2: " . $cuenta2->consultarSaldo() . "€<br>";

    $cuenta1->ingresarDinero(200.0);
    echo "Saldo de cuenta1 tras ingresar 200€: " . $cuenta1->consultarSaldo() . "€<br>";

    $cuenta2->retirarDinero(100.0);
    echo "Saldo de cuenta2 tras retirar 100€: " . $cuenta2->consultarSaldo() . "€<br>";

    $cuenta1->transferirDinero($cuenta2, 300.0);
    echo "Saldo de cuenta1 tras transferir 300€ a cuenta2: " . $cuenta1->consultarSaldo() . "€<br>";
    echo "Saldo de cuenta2 tras recibir 300€ de cuenta1: " . $cuenta2->consultarSaldo() . "€<br>";

    $cuenta1->ingresarDinero(-50.0);
  } catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
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

    public function precioFinal()
    {
      $aumento = 0;

      switch ($this->letra) {
        case "A":
          $aumento += 100;
          break;
        case "B":
          $aumento += 80;
          break;
        case "C":
          $aumento += 60;
          break;
        case "D":
          $aumento += 50;
          break;
        case "E":
          $aumento += 30;
          break;
        case "F":
          $aumento += 10;
          break;
        default:
          echo "No es una letra válida";
          break;
      }

      if ($this->peso >= 0 && $this->peso <= 19) {
        $aumento += 10;
      } elseif ($this->peso >= 20 && $this->peso <= 49) {
        $aumento += 50;
      } elseif ($this->peso >= 50 && $this->peso <= 79) {
        $aumento += 80;
      } elseif ($this->peso > 80) {
        $aumento += 100;
      }

      return $this->precioBase + $aumento;
    }
  }

  class Lavadora extends Electrodomestico
  {
    private float $carga;

    public function __construct()
    {
      parent::__construct(); // Llama al constructor de la clase base con valores por defecto
      $this->carga = 5;
    }

    // Constructor con precio y peso, el resto por defecto
    public function __construct2(float $precioBase, float $peso)
    {
      parent::__construct($precioBase, "blanco", "F", $peso);
      $this->carga = 5;
    }

    // Constructor con carga y el resto de atributos heredados
    public function __construct3(float $precioBase, string $color, string $letra, float $peso, float $carga)
    {
      parent::__construct($precioBase, $color, $letra, $peso);
      $this->carga = $carga;
    }

    public function getCarga(): float
    {
      return $this->carga;
    }

    public function precioFinal(): float
    {
      $precio = parent::precioFinal();
      if ($this->carga > 30) {
        $precio += 50;
      }
      return $precio;
    }
  }

  class Television extends Electrodomestico
  {
    private int $resolucion;
    private bool $sintonizadorTDT;

    public function __construct()
    {
      parent::__construct();
      $this->resolucion = 20;
      $this->sintonizadorTDT = false;
    }

    public function __construct2(float $precioBase, float $peso)
    {
      parent::__construct($precioBase, "blanco", "F", $peso);
      $this->resolucion = 20;
      $this->sintonizadorTDT = false;
    }

    public function __construct3(float $precioBase, string $color, string $letra, float $peso, int $resolucion, bool $sintonizadorTDT)
    {
      parent::__construct($precioBase, $color, $letra, $peso);
      $this->resolucion = $resolucion;
      $this->sintonizadorTDT = $sintonizadorTDT;
    }

    public function getResolucion(): int
    {
      return $this->resolucion;
    }

    public function hasSintonizadorTDT(): bool
    {
      return $this->sintonizadorTDT;
    }

    public function precioFinal(): float
    {
      $precioFinal = parent::precioFinal();

      if ($this->resolucion > 40) {
        $precioFinal += $precioFinal * 0.30;
      }

      if ($this->sintonizadorTDT) {
        $precioFinal += 50;
      }

      return $precioFinal;
    }
  }

  $television1 = new Television();
  echo "Television 1 - Precio: " . $television1->precioFinal() . "€, Resolución: " . $television1->getResolucion() . " pulgadas, Sintonizador TDT: " . ($television1->hasSintonizadorTDT() ? "Sí" : "No") . "<br>";

  $television2 = new Television();
  $television2->__construct2(300, 10);
  echo "Television 2 - Precio: " . $television2->precioFinal() . "€, Resolución: " . $television2->getResolucion() . " pulgadas, Sintonizador TDT: " . ($television2->hasSintonizadorTDT() ? "Sí" : "No") . "<br>";

  $television3 = new Television();
  $television3->__construct3(500, "negro", "B", 12, 45, true);
  echo "Television 3 - Precio: " . $television3->precioFinal() . "€, Resolución: " . $television3->getResolucion() . " pulgadas, Sintonizador TDT: " . ($television3->hasSintonizadorTDT() ? "Sí" : "No") . "<br>";
  ?>

</body>

</html>
