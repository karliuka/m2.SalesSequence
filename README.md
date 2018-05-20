# Magento2 SalesSequence

Extension change format IncrementID for orders, invoices, credit memos and shipments.

## Compatibility

Magento CE(EE) 2.0.x, 2.1.x, 2.2.x

## Install

#### Install via Composer (recommend)

1. Go to Magento2 root folder

2. Enter following commands to install module:

    ```bash
    composer require faonni/module-sales-sequence
    ```
   Wait while dependencies are updated.
   
#### Manual Installation
   
1. Create a folder {Magento root}/app/code/Faonni/SalesSequence

2. Download the corresponding [latest version](https://github.com/karliuka/m2.SalesSequence/releases)

3. Copy the unzip content to the folder ({Magento root}/app/code/Faonni/SalesSequence)

### Completion of installation

1. Go to Magento2 root folder

2. Enter following commands:

    ```bash
	php bin/magento setup:upgrade
	php bin/magento setup:di:compile
	php bin/magento setup:static-content:deploy  (optional)

## Uninstall
This works only with modules defined as Composer packages.

#### Remove database data

1. Go to Magento2 root folder

2. Enter following commands to remove database data:

    ```bash
    php bin/magento module:uninstall -r Faonni_SalesSequence
  
#### Remove Extension
    
1. Go to Magento2 root folder

2. Enter following commands to remove:

    ```bash
    composer remove faonni/module-sales-sequence
    ```

### Completion of uninstall

1. Go to Magento2 root folder

2. Enter following commands:

    ```bash
	php bin/magento setup:upgrade
	php bin/magento setup:di:compile
	php bin/magento setup:static-content:deploy  (optional)



