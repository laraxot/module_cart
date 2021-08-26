<?php

declare(strict_types=1);

return [
    'act' => [
        'indexEdit' => 'Gestisci ordinazioni',
    ],
    'field' => [
        'first_name_label' => 'Nome destinatario',
        'first_name_help' => 'Nome destinatario di riferimento',
        'first_name_placeholder' => 'Inserisci un nome di riferimento',
        'last_name_label' => 'Cognome destinatario',
        'last_name_help' => 'Cognome destinatario di riferimento',
        'last_name_placeholder' => 'Inserisci un cognome di riferimento',
        'destination_label' => 'Indirizzo di destinazione',
        'destination_help' => 'Indirizzo di consegna se differente dal tuo',
        'destination_placeholder' => '',
        'telephone_label' => 'Contatto telefonico',
        'telephone_placeholder' => '',
        'telephone_help' => '',
        'delivery_method_label' => 'Tipo di ritiro',
        'delivery_method_help' => 'Effettuato da te presso il ristorante',
        'customer_fullname_label' => 'Nome destinatario',
        'customer_fullname_placeholder' => '',
        'customer_fullname_help' => 'Nome di riferimento dell\'ordinazione',
    ],
    'checkout' => [
        'partial' => [
            'address' => 'Indirizzo',
            'delivery_method' => 'Modalità consegna',
            'payment_method' => 'Modalità pagamento',
            'order_review' => 'Riepilogo ordine',
        ],
    ],
    'btn' => [
        'take cart bell boy' => 'Prendi in consegna',
    ],
    'status' => [
        'warning' => 'Ricevuto',
        'info' => 'In lavorazione',
        'danger' => 'Rifiutato',
        'primary' => 'Preso in consegna',
        'secondary' => 'In Viaggio',
        'success' => 'Concluso',
    ],
];
