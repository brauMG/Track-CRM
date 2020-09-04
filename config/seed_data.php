<?php

// Database seeder data

return [
    'document_types' => ['Contrato', 'Acuerdo de Licencia', 'Acuerdo de Licencia con el Usuario Final', 'Otro'],
    'task_statuses' => ['Sin Empezar', 'Empezado', 'Completado', 'Cancelado'],
    'task_types' => ['Tarea', 'Reunión', 'Llamada Teléfonica'],
    'contact_status' => ['Prospecto', 'Oportunidad', 'Cliente', 'Cerrado'],
    'settings' => ['crm_email' => 'noreply@crm-track.com', 'enable_email_notification' => 1],
    'permissions' => [
        'create_contact', 'edit_contact', 'delete_contact', 'list_contacts', 'view_contact', 'assign_contact',
        'create_document', 'edit_document', 'delete_document', 'list_documents', 'view_document', 'assign_document',
        'create_task', 'edit_task', 'delete_task', 'list_tasks', 'view_task', 'assign_task', 'update_task_status',
        'edit_profile', 'compose_email', 'list_emails', 'view_email', 'toggle_important_email', 'trash_email', 'send_email',
        'reply_email', 'forward_email', 'show_email_notifications', 'show_calendar', 'list_inventory', 'show-quotations', 'create-quotations',
        'delete-quotations', 'download-quotation', 'show-articles', 'create-articles', 'edit-articles', 'delete-articles', 'show-catalogues',
        'create-catalogues', 'delete-catalogues', 'download-catalogues', 'list-marketing-campaigns', 'show-campaigns', 'create-campaigns', 'delete-campaigns',
        'edit-campaigns', 'copy-link-campaigns', 'preview-campaigns', 'do-campaigns-marketing', 'do-promo-marketing', 'list-reports',
        'do-task-reports', 'do-contacts-reports', 'do-inventory-reports', 'do-campaigns-reports'
    ],
    'mailbox_folders' => array(
        array("title"=>"Bandeja", "icon" => "fa fa-inbox"),
        array("title"=>"Enviados", "icon" => "fa fa-envelope-o"),
        array("title"=>"Borradores", "icon" => "fa fa-file-text-o"),
        array("title"=>"Papelera", "icon" => "fa fa-trash-o")
    )
];
