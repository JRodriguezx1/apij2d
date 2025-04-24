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

    <?php include __DIR__ . '/_ubl_extensions.php'; ?>

    <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID>
    <cbc:CustomizationID><?= $company['type_operation']['code'] ?></cbc:CustomizationID>
    <cbc:ProfileID>DIAN 2.1</cbc:ProfileID>
    <cbc:ProfileExecutionID><?= $company['type_environment']['code'] ?></cbc:ProfileExecutionID>
    <cbc:ID><?= $resolution['next_consecutive'] ?></cbc:ID>
    <cbc:UUID schemeID="<?= $company['type_environment']['code'] ?>" schemeName="<?= $typeDocument['cufe_algorithm'] ?>"/>
    <cbc:IssueDate><?= $date ?? date('Y-m-d') ?></cbc:IssueDate>
    <cbc:IssueTime><?= $time ?? date('H:i:s') ?>-05:00</cbc:IssueTime>
    <cbc:InvoiceTypeCode><?= $typeDocument['code'] ?></cbc:InvoiceTypeCode>
    <cbc:DocumentCurrencyCode><?= $company['type_currency']['code'] ?></cbc:DocumentCurrencyCode>
    <cbc:LineCountNumeric><?= count($invoiceLines) ?></cbc:LineCountNumeric>

    <?php include __DIR__ . '/_accounting.php'; // AccountingSupplierParty con $supplier = true ?>
    <?php include __DIR__ . '/_accounting_customer.php'; // AccountingCustomerParty con $user = $customer ?>
    <?php include __DIR__ . '/_payment_means.php'; ?>
    <?php include __DIR__ . '/_payment_terms.php'; ?>
    <?php include __DIR__ . '/_allowance_charges.php'; ?>
    <?php include __DIR__ . '/_tax_totals.php'; ?>
    <?php include __DIR__ . '/_legal_monetary_total.php'; ?>
    <?php include __DIR__ . '/_invoice_lines.php'; ?>

</Invoice>
