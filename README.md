# Verimod Hide Empty Addresses Module

Magento 2.4.9'da müşteri hesap sayfasında boş adres bloklarını gizleyen bir eklentidir.

## Özellikler

- ✅ Hem faturalama hem de kargo adresleri boş ise **Address Book** bloğu tamamen gizlenir
- ✅ Adreslerden biri varsa, diğer boş adres gizlenir
- ✅ Observer ve şablon geçersiz kılması (override) kullanır
- ✅ Hata yönetimi ve loglama özelliği vardır
- ✅ Magento 2.4.9 ile uyumludur

## Kurulum

### 1. Dosyaları Kopyalayın

Eklentiyi Magento 2 yüklemesine kopyalayın:

```bash
app/code/Verimod/HideEmptyAddresses/
```

### 2. Modülü Etkinleştirin

```bash
php bin/magento module:enable Verimod_HideEmptyAddresses
```

### 3. Veritabanını Güncelleyin

```bash
php bin/magento setup:upgrade
```

### 4. Cache Temizleyin

```bash
php bin/magento cache:clean
```

### 5. Statik İçeriği Dağıtın (Üretim Ortamı)

```bash
php bin/magento setup:static-content:deploy -f
```

## Nasıl Çalışır?

### Observer (HideEmptyAddressesObserver.php)
- `layout_render_before` olayını dinler
- Müşteri dashboard adresler bloğunu kontrol eder
- Boş adresler için bloğu gizler

### Template (addresses.phtml)
- Varsayılan faturalama adresi kontrolü
- Varsayılan kargo adresi kontrolü
- Adresler varsa gösterir, yoksa gizler

## Davranış

✅ **Yeni müşteri hesap açar** → Adres bloğu tamamen gizlenir  
✅ **Müşteri adres ekler** → Adres bloğu görünür  
✅ **Sadece bir adres varsa** → Diğer boş adres gizlenir  

## Devre Dışı Bırakma

Modülü devre dışı bırakmak için:

```bash
php bin/magento module:disable Verimod_HideEmptyAddresses
php bin/magento cache:clean
```

## Dosya Yapısı

```
app/code/Verimod/HideEmptyAddresses/
├── registration.php
├── etc/
│   ├── module.xml
│   ├── frontend/
│   │   ├── events.xml
│   │   └── layout/
│   │       └── customer_account_index.xml
├── Observer/
│   └── HideEmptyAddressesObserver.php
└── view/
    └── frontend/
        └── templates/
            └── dashboard/
                └── addresses.phtml
```

## Gereksinimler

- Magento 2.4.9+
- PHP 7.4+
- Magento_Customer modülü

## Lisans

Mülkiyetli (Proprietary)

## Destek

Sorularınız için: info@verimod.com