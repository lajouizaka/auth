<?php

namespace Core\auth;

class AuthGuard
{
    public string $email;
    public int $id;
    public int $verified;
    private array $permissions;

    public function __construct($user)
    {
        $this->id = $user["id"];
        $this->email = $user["email"];
        $this->verified = $user["verified"];
        $this->permissions = isset($user["user_permissions"]) ? json_decode($user["user_permissions"]) : [];
    }

    public function can_select_products(): bool
    {
        return in_array("can_select_products", $this->permissions);
    }

    public function can_delete_products(): bool
    {
        return in_array("can_delete_products", $this->permissions);
    }

    public function can_update_products(): bool
    {
        return in_array("can_update_products", $this->permissions);
    }

    public function can_insert_products(): bool
    {
        return in_array("can_insert_products", $this->permissions);
    }

    public function can_crud_products(): bool
    {
        return in_array("can_crud_products", $this->permissions);
    }

    public function can_select_categories(): bool
    {
        return in_array("can_select_categories", $this->permissions);
    }

    public function can_delete_categories(): bool
    {
        return in_array("can_delete_categories", $this->permissions);
    }

    public function can_update_categories(): bool
    {
        return in_array("can_update_categories", $this->permissions);
    }

    public function can_insert_categories(): bool
    {
        return in_array("can_insert_categories", $this->permissions);
    }

    public function can_crud_categories(): bool
    {
        return in_array("can_crud_categories", $this->permissions);
    }
}
