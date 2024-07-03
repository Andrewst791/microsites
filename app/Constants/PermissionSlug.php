<?php
declare(strict_types=1);
namespace App\Constants;
use ReflectionClass;

final class PermissionSlug {
    public const string SITES_VIEW_ANY = 'sites.viewAny';
    public const string SITES_VIEW = 'sites.view';
    public const string SITES_UPDATE = 'sites.update';
    public const string SITES_CREATE = 'sites.create';
    public const string SITES_DELETE = 'sites.delete';
    public const string CATEGORIES_VIEW_ANY = 'categories.viewAny';
    public const string CATEGORIES_VIEW = 'categories.view';
    public const string CATEGORIES_UPDATE = 'categories.update';
    public const string CATEGORIES_CREATE = 'categories.create';
    public const string CATEGORIES_DELETE = 'categories.delete';
    public const string USERS_VIEW_ANY = 'users.viewAny';
    public const string USERS_VIEW = 'users.view';
    public const string USERS_UPDATE = 'users.update';
    public const string USERS_CREATE = 'users.create';
    public const string USERS_DELETE = 'users.delete';
    public const string ROLES_VIEW_ANY = 'roles.viewAny';
    public const string ROLES_VIEW = 'roles.view';
    public const string ROLES_UPDATE = 'roles.update';
    public const string ROLES_CREATE = 'roles.create';
    public const string ROLES_DELETE = 'roles.delete';

    public static function toArray(): array
    {
        return (new ReflectionClass(self::class))->getConstants();
    }
}
