<?php foreach ($allowanceCharges as $key => $allowanceCharge): ?>
    <cac:AllowanceCharge>
        <cbc:ID><?= $key + 1 ?></cbc:ID>
        <cbc:ChargeIndicator><?= htmlspecialchars($allowanceCharge->charge_indicator) ?></cbc:ChargeIndicator>
        <?php if (($allowanceCharge->charge_indicator === 'false') && ($allowanceCharge->discount)): ?>
            <cbc:AllowanceChargeReasonCode><?= htmlspecialchars($allowanceCharge->discount->code) ?></cbc:AllowanceChargeReasonCode>
        <?php endif; ?>
        <cbc:AllowanceChargeReason><?= htmlspecialchars($allowanceCharge->allowance_charge_reason) ?></cbc:AllowanceChargeReason>
        <cbc:MultiplierFactorNumeric><?= htmlspecialchars($allowanceCharge->multiplier_factor_numeric) ?></cbc:MultiplierFactorNumeric>
        <cbc:Amount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>"><?= number_format($allowanceCharge->amount, 2, '.', '') ?></cbc:Amount>
        <?php if ($allowanceCharge->base_amount): ?>
            <cbc:BaseAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>"><?= number_format($allowanceCharge->base_amount, 2, '.', '') ?></cbc:BaseAmount>
        <?php endif; ?>
    </cac:AllowanceCharge>
<?php endforeach; ?>