<sts:InvoiceControl>
    <sts:InvoiceAuthorization><?= $resolution->resolution ?></sts:InvoiceAuthorization>
    <sts:AuthorizationPeriod>
        <cbc:StartDate><?= $resolution->date_from ?></cbc:StartDate>
        <cbc:EndDate><?= $resolution->date_to ?></cbc:EndDate>
    </sts:AuthorizationPeriod>
    <sts:AuthorizedInvoices>
        <?php if ($resolution->prefix): ?>
            <sts:Prefix><?= $resolution->prefix ?></sts:Prefix>
        <?php endif; ?>
        <sts:From><?= $resolution->from ?></sts:From>
        <sts:To><?= $resolution->to ?></sts:To>
    </sts:AuthorizedInvoices>
</sts:InvoiceControl>
