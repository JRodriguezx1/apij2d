<?php foreach ($invoiceLines as $key => $invoiceLine): ?>
    <cac:InvoiceLine>
        <cbc:ID><?= $key + 1 ?></cbc:ID>
        <cbc:InvoicedQuantity unitCode="<?= htmlspecialchars($invoiceLine->unit_measure->code) ?>">
            <?= number_format($invoiceLine->invoiced_quantity, 6, '.', '') ?>
        </cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
            <?= number_format($invoiceLine->line_extension_amount, 2, '.', '') ?>
        </cbc:LineExtensionAmount>
        <cbc:FreeOfChargeIndicator><?= htmlspecialchars($invoiceLine->free_of_charge_indicator) ?></cbc:FreeOfChargeIndicator>

        <?php if ($invoiceLine->free_of_charge_indicator === 'true'): ?>
            <cac:PricingReference>
                <cac:AlternativeConditionPrice>
                    <cbc:PriceAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
                        <?= number_format($invoiceLine->price_amount, 2, '.', '') ?>
                    </cbc:PriceAmount>
                    <cbc:PriceTypeCode><?= htmlspecialchars($invoiceLine->reference_price->code) ?></cbc:PriceTypeCode>
                </cac:AlternativeConditionPrice>
            </cac:PricingReference>
        <?php endif; ?>

        <?php include 'allowance_charges.php'; ?>
        <?php include 'tax_totals.php'; ?>

        <cac:Item>
            <cbc:Description><?= htmlspecialchars($invoiceLine->description) ?></cbc:Description>
            <cac:StandardItemIdentification>
                <cbc:ID 
                    schemeID="<?= htmlspecialchars($invoiceLine->type_item_identification->code) ?>" 
                    schemeName="EAN13" 
                    schemeAgencyID="<?= htmlspecialchars($invoiceLine->type_item_identification->code_agency) ?>">
                    <?= htmlspecialchars($invoiceLine->code) ?>
                </cbc:ID>
            </cac:StandardItemIdentification>
        </cac:Item>

        <cac:Price>
            <cbc:PriceAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
                <?= number_format(($invoiceLine->free_of_charge_indicator === 'true') ? 0 : $invoiceLine->price_amount, 2, '.', '') ?>
            </cbc:PriceAmount>
            <cbc:BaseQuantity unitCode="<?= htmlspecialchars($invoiceLine->unit_measure->code) ?>">
                <?= number_format($invoiceLine->base_quantity, 6, '.', '') ?>
            </cbc:BaseQuantity>
        </cac:Price>

    </cac:InvoiceLine>
<?php endforeach; ?>
