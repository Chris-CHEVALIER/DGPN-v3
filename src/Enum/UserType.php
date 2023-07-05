<?php

namespace App\Enum;

enum UserType: string
{
    public const SUPERADMIN = 'SUPERADMIN';
    public const ADMIN = 'ADMIN';
    public const UTILISATEUR = 'UTILISATEUR';
    public const FOURNISSEUR = 'FOURNISSEUR';
}
