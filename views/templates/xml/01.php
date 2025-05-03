<?php echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>'; ?>
<Invoice
    xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
    xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
    xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
    xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
    xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
    xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures"
    xmlns:xades="http://uri.etsi.org/01903/v1.3.2#"
    xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2     http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd">

    <?php include __DIR__ . '/ubl_extensions.php'; ?>

    <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID>
    <cbc:CustomizationID><?= $company->type_operations->code ?></cbc:CustomizationID>
    <cbc:ProfileID>DIAN 2.1</cbc:ProfileID>
    <cbc:ProfileExecutionID><?= $company->type_environments->code ?></cbc:ProfileExecutionID>
    <cbc:ID><?= $resolution->prefix.$resolution->number ?></cbc:ID>
    <cbc:UUID schemeID="<?= $company->type_environments->code ?>" schemeName="<?= $typeDocument->cufe_algorithm ?>"/>
    <cbc:IssueDate><?= $date ?? date('Y-m-d') ?></cbc:IssueDate>
    <cbc:IssueTime><?= $time ?? date('H:i:s') ?>-05:00</cbc:IssueTime>
    <cbc:InvoiceTypeCode><?= $typeDocument->code ?></cbc:InvoiceTypeCode>
    <cbc:DocumentCurrencyCode><?= $company->type_currencies->code ?></cbc:DocumentCurrencyCode>
    <cbc:LineCountNumeric><?= count($invoiceLines) ?></cbc:LineCountNumeric>

    <?php 
include __DIR__ . '/invoice_lines.php';
        /*$node = 'AccountingSupplierParty';
        $supplier = true;
        include __DIR__ . '/accounting.php'; // AccountingSupplierParty con $supplier = true
        
        $node = 'AccountingCustomerParty';
        $supplier = false;
        $user = $customer;
        include __DIR__ . '/accounting.php'; // AccountingCustomerParty con $user = $customer 
        
        /*include __DIR__ . '/payment_means.php'; 
        include __DIR__ . '/payment_terms.php'; 
        include __DIR__ . '/allowance_charges.php'; 
        include __DIR__ . '/tax_totals.php'; 
        include __DIR__ . '/legal_monetary_total.php'; */
        //include __DIR__ . '/invoice_lines.php';
    ?>

</Invoice>
