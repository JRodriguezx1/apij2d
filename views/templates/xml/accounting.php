<cac:<?= htmlspecialchars($node) ?>>
    <cbc:AdditionalAccountID><?= htmlspecialchars($user->company->type_organization->code) ?></cbc:AdditionalAccountID>
    <cac:Party>
        <?php if ($user->company->type_organization->code == 2): ?>
            <cac:PartyIdentification>
                <cbc:ID
                    schemeAgencyID="195"
                    schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"
                    schemeID="<?= htmlspecialchars($user->company->dv) ?>"
                    schemeName="<?= htmlspecialchars($user->company->type_document_identification->code) ?>">
                    <?= htmlspecialchars($user->company->identification_number) ?>
                </cbc:ID>
            </cac:PartyIdentification>
        <?php endif; ?>

        <cac:PartyName>
            <cbc:Name><?= htmlspecialchars($user->name) ?></cbc:Name>
        </cac:PartyName>

        <?php if (isset($supplier)): ?>
            <cac:PhysicalLocation>
                <cac:Address>
                    <cbc:ID><?= htmlspecialchars($user->company->municipality->code) ?></cbc:ID>
                    <cbc:CityName><?= htmlspecialchars($user->company->municipality->name) ?></cbc:CityName>
                    <cbc:CountrySubentity><?= htmlspecialchars($user->company->municipality->department->name) ?></cbc:CountrySubentity>
                    <cbc:CountrySubentityCode><?= htmlspecialchars($user->company->municipality->department->code) ?></cbc:CountrySubentityCode>
                    <cac:AddressLine>
                        <cbc:Line><?= htmlspecialchars($user->company->address) ?></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode><?= htmlspecialchars($user->company->country->code) ?></cbc:IdentificationCode>
                        <cbc:Name languageID="<?= htmlspecialchars($user->company->language->code) ?>">
                            <?= htmlspecialchars($user->company->country->name) ?>
                        </cbc:Name>
                    </cac:Country>
                </cac:Address>
            </cac:PhysicalLocation>
        <?php endif; ?>

        <cac:PartyTaxScheme>
            <cbc:RegistrationName><?= htmlspecialchars($user->name) ?></cbc:RegistrationName>
            <cbc:CompanyID 
                schemeAgencyID="195"
                schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"
                schemeID="<?= htmlspecialchars($user->company->dv) ?>"
                schemeName="<?= htmlspecialchars($user->company->type_document_identification->code) ?>">
                <?= htmlspecialchars($user->company->identification_number) ?>
            </cbc:CompanyID>
            <cbc:TaxLevelCode listName="<?= htmlspecialchars($user->company->type_regime->code) ?>">
                <?= htmlspecialchars($user->company->type_liability->code) ?>
            </cbc:TaxLevelCode>
            <cac:RegistrationAddress>
                <cbc:ID><?= htmlspecialchars($user->company->municipality->code) ?></cbc:ID>
                <cbc:CityName><?= htmlspecialchars($user->company->municipality->name) ?></cbc:CityName>
                <cbc:CountrySubentity><?= htmlspecialchars($user->company->municipality->department->name) ?></cbc:CountrySubentity>
                <cbc:CountrySubentityCode><?= htmlspecialchars($user->company->municipality->department->code) ?></cbc:CountrySubentityCode>
                <cac:AddressLine>
                    <cbc:Line><?= htmlspecialchars($user->company->address) ?></cbc:Line>
                </cac:AddressLine>
                <cac:Country>
                    <cbc:IdentificationCode><?= htmlspecialchars($user->company->country->code) ?></cbc:IdentificationCode>
                    <cbc:Name languageID="<?= htmlspecialchars($user->company->language->code) ?>">
                        <?= htmlspecialchars($user->company->country->name) ?>
                    </cbc:Name>
                </cac:Country>
            </cac:RegistrationAddress>
            <cac:TaxScheme>
                <cbc:ID><?= htmlspecialchars($user->company->tax->code) ?></cbc:ID>
                <cbc:Name><?= htmlspecialchars($user->company->tax->name) ?></cbc:Name>
            </cac:TaxScheme>
        </cac:PartyTaxScheme>

        <cac:PartyLegalEntity>
            <cbc:RegistrationName><?= htmlspecialchars($user->name) ?></cbc:RegistrationName>
            <cbc:CompanyID 
                schemeAgencyID="195"
                schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"
                schemeID="<?= htmlspecialchars($user->company->dv) ?>"
                schemeName="<?= htmlspecialchars($user->company->type_document_identification->code) ?>">
                <?= htmlspecialchars($user->company->identification_number) ?>
            </cbc:CompanyID>
            <cac:CorporateRegistrationScheme>
                <?php if (isset($supplier)): ?>
                    <cbc:ID><?= htmlspecialchars($resolution->prefix) ?></cbc:ID>
                <?php endif; ?>
                <cbc:Name><?= htmlspecialchars($user->company->merchant_registration) ?></cbc:Name>
            </cac:CorporateRegistrationScheme>
        </cac:PartyLegalEntity>

        <cac:Contact>
            <cbc:Telephone><?= htmlspecialchars($user->company->phone) ?></cbc:Telephone>
            <cbc:ElectronicMail><?= htmlspecialchars($user->email) ?></cbc:ElectronicMail>
        </cac:Contact>
    </cac:Party>
</cac:<?= htmlspecialchars($node) ?>>