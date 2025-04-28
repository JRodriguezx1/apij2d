<cac:<?= htmlspecialchars($node) ?>>
    <cbc:AdditionalAccountID><?= htmlspecialchars($company->type_organizations->code) ?></cbc:AdditionalAccountID>
    <cac:Party>
        <?php if ($company->type_organizations->code == 2): ?>
            <cac:PartyIdentification>
                <cbc:ID
                    schemeAgencyID="195"
                    schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"
                    schemeID="<?= htmlspecialchars($company->dv) ?>"
                    schemeName="<?= htmlspecialchars($company->type_document_identifications->code) ?>">
                    <?= htmlspecialchars($company->identification_number) ?>
                </cbc:ID>
            </cac:PartyIdentification>
        <?php endif; ?>

        <cac:PartyName>
            <cbc:Name><?= htmlspecialchars($user->name) ?></cbc:Name>
        </cac:PartyName>

        <?php if (isset($supplier)): ?>
            <cac:PhysicalLocation>
                <cac:Address>
                    <cbc:ID><?= htmlspecialchars($company->municipalities->code) ?></cbc:ID>
                    <cbc:CityName><?= htmlspecialchars($company->municipalities->name) ?></cbc:CityName>
                    <cbc:CountrySubentity><?= htmlspecialchars($company->municipalities->departments->name) ?></cbc:CountrySubentity>
                    <cbc:CountrySubentityCode><?= htmlspecialchars($company->municipalities->departments->code) ?></cbc:CountrySubentityCode>
                    <cac:AddressLine>
                        <cbc:Line><?= htmlspecialchars($company->address) ?></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode><?= htmlspecialchars($company->country->code) ?></cbc:IdentificationCode>
                        <cbc:Name languageID="<?= htmlspecialchars($company->languages->code) ?>">
                            <?= htmlspecialchars($company->country->name) ?>
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
                schemeID="<?= htmlspecialchars($company->dv) ?>"
                schemeName="<?= htmlspecialchars($company->type_document_identifications->code) ?>">
                <?= htmlspecialchars($company->identification_number) ?>
            </cbc:CompanyID>
            <cbc:TaxLevelCode listName="<?= htmlspecialchars($company->type_regimes->code) ?>">
                <?= htmlspecialchars($company->type_liabilities->code) ?>
            </cbc:TaxLevelCode>
            <cac:RegistrationAddress>
                <cbc:ID><?= htmlspecialchars($company->municipalities->code) ?></cbc:ID>
                <cbc:CityName><?= htmlspecialchars($company->municipalities->name) ?></cbc:CityName>
                <cbc:CountrySubentity><?= htmlspecialchars($company->municipalities->departments->name) ?></cbc:CountrySubentity>
                <cbc:CountrySubentityCode><?= htmlspecialchars($company->municipalities->departments->code) ?></cbc:CountrySubentityCode>
                <cac:AddressLine>
                    <cbc:Line><?= htmlspecialchars($company->address) ?></cbc:Line>
                </cac:AddressLine>
                <cac:Country>
                    <cbc:IdentificationCode><?= htmlspecialchars($company->country->code) ?></cbc:IdentificationCode>
                    <cbc:Name languageID="<?= htmlspecialchars($company->languages->code) ?>">
                        <?= htmlspecialchars($company->country->name) ?>
                    </cbc:Name>
                </cac:Country>
            </cac:RegistrationAddress>
            <cac:TaxScheme>
                <cbc:ID><?= htmlspecialchars($company->taxes->code) ?></cbc:ID>
                <cbc:Name><?= htmlspecialchars($company->taxes->name) ?></cbc:Name>
            </cac:TaxScheme>
        </cac:PartyTaxScheme>

        <cac:PartyLegalEntity>
            <cbc:RegistrationName><?= htmlspecialchars($user->name) ?></cbc:RegistrationName>
            <cbc:CompanyID 
                schemeAgencyID="195"
                schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"
                schemeID="<?= htmlspecialchars($company->dv) ?>"
                schemeName="<?= htmlspecialchars($company->type_document_identifications->code) ?>">
                <?= htmlspecialchars($company->identification_number) ?>
            </cbc:CompanyID>
            <cac:CorporateRegistrationScheme>
                <?php if (isset($supplier)): ?>
                    <cbc:ID><?= htmlspecialchars($resolution->prefix) ?></cbc:ID>
                <?php endif; ?>
                <cbc:Name><?= htmlspecialchars($company->merchant_registration) ?></cbc:Name>
            </cac:CorporateRegistrationScheme>
        </cac:PartyLegalEntity>

        <cac:Contact>
            <cbc:Telephone><?= htmlspecialchars($company->phone) ?></cbc:Telephone>
            <cbc:ElectronicMail><?= htmlspecialchars($user->email) ?></cbc:ElectronicMail>
        </cac:Contact>
    </cac:Party>
</cac:<?= htmlspecialchars($node) ?>>