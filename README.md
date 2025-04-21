# SETW API Wrapper

Librería par el consumo de datos del Sistema de Emisión de Terrawind.

Esta libería tiene el objetivo de simplicar la consulta de datos de SETW y mejorará el tiempo de implementación.

## Instalación

### Requisitos básicos
- PHP 8.0 o superior

### Pasos para Instalación
`git clone https://github.com/cristof-g/setw-api-wrapper.git`

### Métodos Disponibles
#### Countries
Obtener todos los paises

```php
$country =  new Country($credentials);
$country->get();
```

Obtener país por región
```php
$country =  new Country($credentials);
$country->getByRegionId($regionId);
```

#### Currencies
Obtener todos las divisas

```php
$currency =  new Currency($credentials);
$currency->get();
```

#### Documents Types
Obtener tipo de documentos

```php
$documentType =  new DocumentType($credentials);
$docuentType->get();
```

#### Products
Obtener todos los productos disponibles

```php
$product =  new Product($credentials);
$product->get();
```

Obtener todos los productos con comisiones

```php
$product =  new Product($credentials);
$product->getWithComissions();
```


#### Regions
Obtener las regiones

```php
$region =  new Region($credentials);
$region->get();
```

#### Tariffs
Obtener tarifa por producto

```php
$tariff = new Tariff($credentials);
$tariff->getByProductId($productId);
```

#### Upgrades
Obtener los Upgrades (Coberturas adicionales)

```php
$upgrade = new Upgrade($credentials);
$upgrade->get($productId, $passengerAge, $tripDays);
```

#### Voucher
Agregar voucher

```php
$voucher = new Voucher($credentials);
$voucher->add($voucherData);
```

Editar voucher

```php
$voucher = new Voucher($credentials);
$voucher->edit($voucherData);
```

Obtener todos los vouchers

```php
$voucher = new Voucher($credentials);
$voucher->get();
```

Obtener Link del voucher

```php
$voucher = new Voucher($credentials);
$voucher->link($voucherNumber, $voucherKey);
```

Obtener precio del voucher

```php
$voucher = new Voucher($credentials);
$voucher->price($voucherData);
```

Obtener el estatus del voucher

```php
$voucher = new Voucher($credentials);
$voucher->status($voucherNumber);
```

Requerir anulación del voucher

```php
$voucher = new Voucher($credentials);
$voucher->requireAnnulation($voucherNumber, $comments);
```

Validar voucher

```php
$voucher = new Voucher($credentials);
$voucher->check($voucherData);
```

Obener información por número de voucher

```php
$voucher = new Voucher($credentials);
$voucher->getByVoucherNumber($voucherNumber);
```

Obtener número de vouchers emitidos por el sitema (Activos y cancelados)

```php
$voucher = new Voucher($credentials);
$voucher->countVouchers($filter);
```

> [!NOTE]
> Para saber que información y tipo de datos se debe enviar favor de revisar la documentación de SETW