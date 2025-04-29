<cac:PaymentMeans>
    <cbc:ID><?= $paymentForm->code ?></cbc:ID>
    <cbc:PaymentMeansCode><?= $paymentForm->payment_method_code ?></cbc:PaymentMeansCode>
    <?php if($paymentForm->code == '2'): ?>
        <cbc:PaymentDueDate><?= $paymentForm->payment_due_date ?></cbc:PaymentDueDate>
    <?php endif; ?>
    <cbc:PaymentID><?= $paymentForm->payment_id??1 ?></cbc:PaymentID>
</cac:PaymentMeans>