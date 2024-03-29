<?php

namespace AbandonedCart\Shell;

use Cake\Console\Shell;
use Cake\Mailer;

/**
 * Notify shell command.
 */
class NotifyShell extends Shell
{

    use Mailer\MailerAwareTrait;

    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('AbandonedCart.Sessions');

        /* $start_date = (new \DateTime('-1 hours'))->format('Y-m-d H:i:s');
        $end_date = (new \DateTime())->format('Y-m-d H:i:s');

        $sessions = $this->Sessions->find('all', [
            'conditions' => function ($q) use ($start_date, $end_date) {
                return $q->between('created', $start_date, $end_date);
            },
        ]); */

        $sessions = $this->Sessions->find('all', [
            'conditions' => ['notified IS' => NULL]
        ]);

        $customerNotified = [];

        foreach ($sessions as $session) {
            if (!empty($session->cart_total)) {
                $cartDetails = [
                    'products' => $session->products,
                    'name' => $session->customer_name,
                    'email' => $session->email_address,
                    'cartPriceBreakdown' => $session->cart_details,
                    'currency' => $session->default_currency,
                ];

                if (!empty($cartDetails['email']) && !in_array($cartDetails['email'], $customerNotified)) {
                    array_push($customerNotified, $cartDetails['email']);
                    $this->getMailer('AbandonedCart.Notify')->send('notifyCustomer', [$cartDetails]);
                }
            }

            $this->Sessions->query()->update()->set(['notified' => 1])->where(['id' => $session->id])->execute();
        }
    }
}
