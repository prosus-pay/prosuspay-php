<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class InvoiceList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\Invoice[]
     */
    public function all(): array
    {
        $invoices = [];
        foreach ($this->getData() as $invoice) {
            $invoices[] = new \ProsusPay\Result\Invoice($invoice);
        }
        return $invoices;
    }

    /**
     * @return \ProsusPay\Result\Invoice[]
     */
    public function getInvoicesByStatus(string $status): array
    {
        $r = array_filter(
            $this->all(),
            function (\ProsusPay\Result\Invoice $invoice) use ($status) {
                return $invoice->getStatus() === $status;
            }
        );

        // Renumber results
        return array_values($r);
    }
}
