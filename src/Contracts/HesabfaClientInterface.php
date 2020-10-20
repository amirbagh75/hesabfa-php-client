<?php


namespace Amirbagh75\HesabfaClient\Contracts;

interface HesabfaClientInterface
{
    // doc sections: https://www.hesabfa.com/help/api/Contact
    public function getContact(string $contactCode);
    public function getContactsList(array $queryInfo);
    public function getContactsByID(array $contactsID);

    // doc sections: https://www.hesabfa.com/help/api/Invoice
    public function getInvoices(string $invoiceType, array $queryInfo);
}
