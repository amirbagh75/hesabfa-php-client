<?php

namespace Amirbagh75\HesabfaClient\Contracts;

interface HesabfaClientInterface
{
    // Contacts - docs: https://www.hesabfa.com/help/api/Contact
    public function getContact(string $contactCode);

    public function getContactsList(array $queryInfo);

    public function getContactsByID(array $contactsID);

    // Invoices - docs: https://www.hesabfa.com/help/api/Invoice
    public function getInvoices(string $invoiceType, array $queryInfo);

    // Hooks - docs: https://www.hesabfa.com/help/api/Hook
    public function setWebHook(string $url, string $hookPassword);

    // Items - docs: https://www.hesabfa.com/help/api/Item
    public function getItemByID(array $idList);
}
