<cac:PaymentTerms>
    <cbc:ReferenceEventCode><?= htmlspecialchars($paymentForm->code) ?></cbc:ReferenceEventCode>
    <?php if ($paymentForm->code == '2'): ?>
        <cac:SettlementPeriod>
            <cbc:DurationMeasure unitCode="<?= htmlspecialchars($paymentForm->duration_measure_unit_code??'DAY') ?>"><?= htmlspecialchars($paymentForm->duration_measure) ?></cbc:DurationMeasure>
        </cac:SettlementPeriod>
    <?php endif; ?>
</cac:PaymentTerms>