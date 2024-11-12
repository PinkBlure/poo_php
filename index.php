<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  class CuentaCorriente {

    private string $cuenta;
    private string $nombre;
    private float $importe;

    public function __construct(string $cuenta, string $nombre, float $importe) {
      $this->cuenta = $cuenta;
      $this->nombre = $nombre;
      $this->importe = $importe;
    }

    public function ingresarDinero(float $cantidad): void {
      if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad a ingresar debe ser mayor que 0");
      } $this->importe += $cantidad;
    }

    public function retirarDinero(float $cantidad): void {
      if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad a retirar debe ser mayor que 0");
      } elseif ($cantidad > $this->importe) {
        throw new InvalidArgumentException("La cantidad a retirar debe ser menor o igual que la cantidad que tengas en el banco");
      } $this->importe += $cantidad;
    }

    public function transferirDinero(CuentaCorriente $cuenta, float $cantidad) {
      if ($cantidad <= 0) {
        throw new InvalidArgumentException("La cantidad a transferir debe ser mayor que 0");
      } elseif ($cantidad > $this->importe) {
        throw new InvalidArgumentException("La cantidad a transferir debe ser menor o igual que la cantidad que tengas en el banco");
      }
      $this->retirarDinero($cantidad);
      $cuenta->ingresarDinero($cantidad);
    }

    public function consultarSaldo(): float{
      return $this->importe;
    }

  }
  ?>
</body>

</html>
