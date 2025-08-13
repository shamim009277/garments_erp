<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_debugbar/open' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.openhandler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/stylesheets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.css',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/javascript' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.js',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/queries/explain' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.queries.explain',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OdXMfhnKB5cDsjhH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.profile.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'user.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'user.profile.destroy',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y5aGiMMkaVPTm3wH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verify-email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/verification-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.send',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QqQyU8cpNALpCtpX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/module/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/module/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/modules' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/modules/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/menu/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/menu/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/menus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/menus/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/permission/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/permission/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/permissions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/role/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/role/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/user/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/user/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration/authorization/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master/system-settings/general-settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.system-settings.general-settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master.system-settings.general-settings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master/setup/units/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.units.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master/setup/units/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.units.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master/setup/units' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master/setup/units/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/hris' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.hris.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.hris.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/nationalities/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/nationalities/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/nationalities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/nationalities/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/maritalstatus/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/maritalstatus/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/maritalstatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/maritalstatus/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sex/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sex/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sex' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sex/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/religions/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/religions/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/religions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/religions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/divisions/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/divisions/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/divisions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/divisions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/districts/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/districts/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/districts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/districts/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/thanas/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/thanas/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/thanas' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/thanas/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/unions/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/unions/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/unions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/unions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/educationboards/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/educationboards/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/educationboards' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/educationboards/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/documents/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/documents/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/documents' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/documents/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sourcereferences/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sourcereferences/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sourcereferences' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/sourcereferences/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/employeecategories/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/employeecategories/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/employeecategories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/employeecategories/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/organizations/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/organizations/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/organizations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/organizations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/shifts/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/shifts/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/shifts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/shifts/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/leaveclassifications/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/leaveclassifications/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/leaveclassifications' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/leaveclassifications/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdepartments/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdepartments/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdepartments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdepartments/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdesignations/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdesignations/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdesignations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/parentdesignations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/departments/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/departments/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/departments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/departments/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/designations/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/designations/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/designations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/designations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/degrees/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/degrees/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/degrees' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/degrees/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_purpose/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_purpose/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_purpose' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_purpose/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_reason/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_reason/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_reason' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/setup/gatepass_reason/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/new-applicants/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.search',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/new-applicants/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/new-applicants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/new-applicants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-idassign' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-idassign/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.search',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee/bangla' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.bangla',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee/salary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.salary',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee/personal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.personal',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee/document' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.document',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-education/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-education' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-education/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-training/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-training' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-training/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-experience/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-experience' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-experience/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-reference/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-reference' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-reference/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-service/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-service' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/database/employee-service/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/report/employee-listings/preview' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.preview',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/report/employee-listings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/report/employee-listings/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/settings/hr-settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/settings/hr-settings/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/settings/forward-approve' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hris/settings/forward-approve/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/inventories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.inventory.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.inventory.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/parties/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/parties/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/parties' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/parties/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storetypes/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storetypes/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storetypes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storetypes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelines/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelines/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelines' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelines/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/racklocations/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/racklocations/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/racklocations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/racklocations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelocations/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelocations/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelocations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/storelocations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliertypes/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliertypes/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliertypes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliertypes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliers/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliers/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/suppliers/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/challanpurposes/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/challanpurposes/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/challanpurposes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/challanpurposes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodscategories/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodscategories/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodscategories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodscategories/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodsSubCategories/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodsSubCategories/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodsSubCategories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/goodsSubCategories/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/countries/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/countries/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/countries' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/countries/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colorgroups/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colorgroups/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colorgroups' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colorgroups/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colors/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colors/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colors' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/colors/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizegroups/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizegroups/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizegroups' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizegroups/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizes/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizes/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/sizes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/buyers/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/buyers/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/buyers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/buyers/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/items/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/items/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/items/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/inventory/setup/items/get-subcategories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.getSubcategories',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/compositions/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/compositions/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/compositions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/compositions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/yarncounts/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/yarncounts/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/yarncounts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/yarncounts/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictypes/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictypes/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictypes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictypes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictreatments/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictreatments/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictreatments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/fabictreatments/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/productcategories/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/productcategories/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/productcategories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/setup/productcategories/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/database/basicorders/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/database/basicorders/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/database/basicorders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inventory/database/basicorders/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/payrolls' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.payroll.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.payroll.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payroll' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/payroll/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|lockwork/([^/]++)(*:39)|ache/([^/]++)(?:/([^/]++))?(*:73))|/reset\\-password/([^/]++)(*:106)|/verify\\-email/([^/]++)/([^/]++)(*:146)|/a(?|dministration/(?|m(?|odules/([^/]++)(?|(*:198)|/edit(*:211)|(*:219))|enu(?|/([^/]++)/(?|parents(*:254)|childs(*:268))|s/([^/]++)(?|(*:290)|/edit(*:303)|(*:311))))|authorization/(?|permissions/([^/]++)(?|(*:362)|/edit(*:375)|(*:383))|roles/([^/]++)(?|(*:409)|/edit(*:422)|(*:430))|users/([^/]++)(?|(*:456)|/edit(*:469)|(*:477))))|pi/v1/(?|hris/([^/]++)(?|(*:513))|inventories/([^/]++)(?|(*:545))|payrolls/([^/]++)(?|(*:574))))|/master/setup/units/([^/]++)(?|(*:616)|/edit(*:629)|(*:637))|/hris/(?|([^/]++)(?|(*:666)|/edit(*:679)|(*:687))|set(?|up/(?|nationalities/([^/]++)(?|(*:733)|/edit(*:746)|(*:754))|maritalstatus/([^/]++)(?|(*:788)|/edit(*:801)|(*:809))|s(?|ex/([^/]++)(?|(*:836)|/edit(*:849)|(*:857))|ourcereferences/([^/]++)(?|(*:893)|/edit(*:906)|(*:914))|hifts/([^/]++)(?|(*:940)|/edit(*:953)|(*:961)))|religions/([^/]++)(?|(*:992)|/edit(*:1005)|(*:1014))|d(?|i(?|visions/([^/]++)(?|(*:1051)|/edit(*:1065)|(*:1074))|stricts/([^/]++)(?|(*:1103)|/edit(*:1117)|(*:1126)))|ocuments/([^/]++)(?|(*:1157)|/edit(*:1171)|(*:1180))|e(?|partments/([^/]++)(?|(*:1215)|/edit(*:1229)|(*:1238))|signations/([^/]++)(?|(*:1270)|/edit(*:1284)|(*:1293))|grees/([^/]++)(?|(*:1320)|/edit(*:1334)|(*:1343))))|thanas/([^/]++)(?|(*:1373)|/edit(*:1387)|(*:1396))|unions/([^/]++)(?|(*:1424)|/edit(*:1438)|(*:1447))|e(?|ducationboards/([^/]++)(?|(*:1487)|/edit(*:1501)|(*:1510))|mployeecategories/([^/]++)(?|(*:1549)|/edit(*:1563)|(*:1572)))|organizations/([^/]++)(?|(*:1608)|/edit(*:1622)|(*:1631))|leaveclassifications/([^/]++)(?|(*:1673)|/edit(*:1687)|(*:1696))|parentde(?|partments/([^/]++)(?|(*:1738)|/edit(*:1752)|(*:1761))|signations/([^/]++)(?|(*:1793)|/edit(*:1807)|(*:1816)))|gatepass_(?|purpose/([^/]++)(?|(*:1858)|/edit(*:1872)|(*:1881))|reason/([^/]++)(?|(*:1909)|/edit(*:1923)|(*:1932))))|tings/(?|hr\\-settings/([^/]++)(?|(*:1977)|/edit(*:1991)|(*:2000))|forward\\-approve/([^/]++)(?|(*:2038)|/edit(*:2052)|(*:2061))))|database/(?|new\\-applicants/([^/]++)(?|(*:2112)|/edit(*:2126)|(*:2135))|employee(?|\\-(?|idassign/([^/]++)(?|(*:2181)|/edit(*:2195)|(*:2204))|e(?|ducation/([^/]++)(?|(*:2238)|/edit(*:2252)|(*:2261))|xperience/([^/]++)(?|(*:2292)|/edit(*:2306)|(*:2315)))|training/([^/]++)(?|(*:2346)|/edit(*:2360)|(*:2369))|reference/([^/]++)(?|(*:2400)|/edit(*:2414)|(*:2423))|service/([^/]++)(?|(*:2452)|/edit(*:2466)|(*:2475)))|/([^/]++)(?|(*:2498)|/edit(*:2512)|(*:2521)))|d(?|esignation/([^/]++)(*:2555)|istrict/([^/]++)(*:2580)))|report/employee\\-listings/([^/]++)(?|(*:2628)|/edit(*:2642)|(*:2651)))|/inventory/(?|([^/]++)(?|(*:2687)|/edit(*:2701)|(*:2710))|setup/(?|p(?|arties/([^/]++)(?|(*:2751)|/edit(*:2765)|(*:2774))|roductcategories/([^/]++)(?|(*:2812)|/edit(*:2826)|(*:2835)))|s(?|tore(?|types/([^/]++)(?|(*:2874)|/edit(*:2888)|(*:2897))|l(?|ines/([^/]++)(?|(*:2927)|/edit(*:2941)|(*:2950))|ocations/([^/]++)(?|(*:2980)|/edit(*:2994)|(*:3003))))|upplier(?|types/([^/]++)(?|(*:3042)|/edit(*:3056)|(*:3065))|s/([^/]++)(?|(*:3088)|/edit(*:3102)|(*:3111)))|ize(?|groups/([^/]++)(?|(*:3146)|/edit(*:3160)|(*:3169))|s/([^/]++)(?|(*:3192)|/edit(*:3206)|(*:3215))))|racklocations/([^/]++)(?|(*:3252)|/edit(*:3266)|(*:3275))|c(?|hallanpurposes/([^/]++)(?|(*:3315)|/edit(*:3329)|(*:3338))|o(?|untries/([^/]++)(?|(*:3371)|/edit(*:3385)|(*:3394))|lor(?|groups/([^/]++)(?|(*:3428)|/edit(*:3442)|(*:3451))|s/([^/]++)(?|(*:3474)|/edit(*:3488)|(*:3497)))|mpositions/([^/]++)(?|(*:3530)|/edit(*:3544)|(*:3553))))|goods(?|categories/([^/]++)(?|(*:3595)|/edit(*:3609)|(*:3618))|SubCategories/([^/]++)(?|(*:3653)|/edit(*:3667)|(*:3676)))|buyers/([^/]++)(?|(*:3705)|/edit(*:3719)|(*:3728))|items/([^/]++)(?|(*:3755)|/edit(*:3769)|(*:3778))|yarncounts/([^/]++)(?|(*:3810)|/edit(*:3824)|(*:3833))|fabict(?|ypes/([^/]++)(?|(*:3868)|/edit(*:3882)|(*:3891))|reatments/([^/]++)(?|(*:3922)|/edit(*:3936)|(*:3945))))|database/basicorders/([^/]++)(?|(*:3989)|/edit(*:4003)|(*:4012)))|/payroll/([^/]++)(?|(*:4043)|/edit(*:4057)|(*:4066))|/storage/(.*)(*:4089))/?$}sDu',
    ),
    3 => 
    array (
      39 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.clockwork',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      73 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.cache.delete',
            'tags' => NULL,
          ),
          1 => 
          array (
            0 => 'key',
            1 => 'tags',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      106 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      146 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.verify',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'hash',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      198 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.show',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      211 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.edit',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      219 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.update',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.module.destroy',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      254 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.parents',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      268 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.childs',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      290 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.show',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      303 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.edit',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.update',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.menu.destroy',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      362 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.show',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.edit',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      383 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.update',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.permission.destroy',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      409 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.show',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      422 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.edit',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      430 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.update',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.role.destroy',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      456 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      469 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      477 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'administration.authorization.user.destroy',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      513 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.hris.show',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.hris.update',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'api.hris.destroy',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      545 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.inventory.show',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.inventory.update',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'api.inventory.destroy',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      574 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.payroll.show',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.payroll.update',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'api.payroll.destroy',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      616 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.show',
          ),
          1 => 
          array (
            0 => 'unit',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      629 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.edit',
          ),
          1 => 
          array (
            0 => 'unit',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      637 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.update',
          ),
          1 => 
          array (
            0 => 'unit',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master.setup.unit.destroy',
          ),
          1 => 
          array (
            0 => 'unit',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      666 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.show',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      679 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.edit',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      687 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.update',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.destroy',
          ),
          1 => 
          array (
            0 => 'hri',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      733 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.show',
          ),
          1 => 
          array (
            0 => 'nationality',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      746 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.edit',
          ),
          1 => 
          array (
            0 => 'nationality',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      754 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.update',
          ),
          1 => 
          array (
            0 => 'nationality',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.nationalities.destroy',
          ),
          1 => 
          array (
            0 => 'nationality',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      788 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.show',
          ),
          1 => 
          array (
            0 => 'maritalstatus',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      801 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.edit',
          ),
          1 => 
          array (
            0 => 'maritalstatus',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      809 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.update',
          ),
          1 => 
          array (
            0 => 'maritalstatus',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.maritalstatus.destroy',
          ),
          1 => 
          array (
            0 => 'maritalstatus',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      836 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.show',
          ),
          1 => 
          array (
            0 => 'sex',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      849 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.edit',
          ),
          1 => 
          array (
            0 => 'sex',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      857 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.update',
          ),
          1 => 
          array (
            0 => 'sex',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sex.destroy',
          ),
          1 => 
          array (
            0 => 'sex',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      893 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.show',
          ),
          1 => 
          array (
            0 => 'sourcereference',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      906 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.edit',
          ),
          1 => 
          array (
            0 => 'sourcereference',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      914 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.update',
          ),
          1 => 
          array (
            0 => 'sourcereference',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.sourcereferences.destroy',
          ),
          1 => 
          array (
            0 => 'sourcereference',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      940 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.show',
          ),
          1 => 
          array (
            0 => 'shift',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      953 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.edit',
          ),
          1 => 
          array (
            0 => 'shift',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      961 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.update',
          ),
          1 => 
          array (
            0 => 'shift',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.shifts.destroy',
          ),
          1 => 
          array (
            0 => 'shift',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      992 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.show',
          ),
          1 => 
          array (
            0 => 'religion',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1005 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.edit',
          ),
          1 => 
          array (
            0 => 'religion',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1014 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.update',
          ),
          1 => 
          array (
            0 => 'religion',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.religions.destroy',
          ),
          1 => 
          array (
            0 => 'religion',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1051 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.show',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1065 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.edit',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.update',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.divisions.destroy',
          ),
          1 => 
          array (
            0 => 'division',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1103 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.show',
          ),
          1 => 
          array (
            0 => 'district',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1117 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.edit',
          ),
          1 => 
          array (
            0 => 'district',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1126 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.update',
          ),
          1 => 
          array (
            0 => 'district',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.districts.destroy',
          ),
          1 => 
          array (
            0 => 'district',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1157 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.show',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1171 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.edit',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1180 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.update',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.documents.destroy',
          ),
          1 => 
          array (
            0 => 'document',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1215 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.show',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1229 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.edit',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1238 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.update',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.departments.destroy',
          ),
          1 => 
          array (
            0 => 'department',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1270 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.show',
          ),
          1 => 
          array (
            0 => 'designation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1284 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.edit',
          ),
          1 => 
          array (
            0 => 'designation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1293 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.update',
          ),
          1 => 
          array (
            0 => 'designation',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.designations.destroy',
          ),
          1 => 
          array (
            0 => 'designation',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1320 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.show',
          ),
          1 => 
          array (
            0 => 'degree',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1334 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.edit',
          ),
          1 => 
          array (
            0 => 'degree',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1343 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.update',
          ),
          1 => 
          array (
            0 => 'degree',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.degrees.destroy',
          ),
          1 => 
          array (
            0 => 'degree',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1373 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.show',
          ),
          1 => 
          array (
            0 => 'thana',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1387 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.edit',
          ),
          1 => 
          array (
            0 => 'thana',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1396 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.update',
          ),
          1 => 
          array (
            0 => 'thana',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.thanas.destroy',
          ),
          1 => 
          array (
            0 => 'thana',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1424 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.show',
          ),
          1 => 
          array (
            0 => 'union',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.edit',
          ),
          1 => 
          array (
            0 => 'union',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1447 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.update',
          ),
          1 => 
          array (
            0 => 'union',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.unions.destroy',
          ),
          1 => 
          array (
            0 => 'union',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1487 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.show',
          ),
          1 => 
          array (
            0 => 'educationboard',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1501 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.edit',
          ),
          1 => 
          array (
            0 => 'educationboard',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1510 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.update',
          ),
          1 => 
          array (
            0 => 'educationboard',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.educationboards.destroy',
          ),
          1 => 
          array (
            0 => 'educationboard',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1549 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.show',
          ),
          1 => 
          array (
            0 => 'employeecategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1563 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.edit',
          ),
          1 => 
          array (
            0 => 'employeecategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1572 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.update',
          ),
          1 => 
          array (
            0 => 'employeecategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.employeecategories.destroy',
          ),
          1 => 
          array (
            0 => 'employeecategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1608 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.show',
          ),
          1 => 
          array (
            0 => 'organization',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1622 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.edit',
          ),
          1 => 
          array (
            0 => 'organization',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1631 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.update',
          ),
          1 => 
          array (
            0 => 'organization',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.organizations.destroy',
          ),
          1 => 
          array (
            0 => 'organization',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1673 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.show',
          ),
          1 => 
          array (
            0 => 'leaveclassification',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1687 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.edit',
          ),
          1 => 
          array (
            0 => 'leaveclassification',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1696 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.update',
          ),
          1 => 
          array (
            0 => 'leaveclassification',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.leaveclassifications.destroy',
          ),
          1 => 
          array (
            0 => 'leaveclassification',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1738 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.show',
          ),
          1 => 
          array (
            0 => 'parentdepartment',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1752 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.edit',
          ),
          1 => 
          array (
            0 => 'parentdepartment',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1761 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.update',
          ),
          1 => 
          array (
            0 => 'parentdepartment',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdepartments.destroy',
          ),
          1 => 
          array (
            0 => 'parentdepartment',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1793 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.show',
          ),
          1 => 
          array (
            0 => 'parentdesignation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1807 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.edit',
          ),
          1 => 
          array (
            0 => 'parentdesignation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1816 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.update',
          ),
          1 => 
          array (
            0 => 'parentdesignation',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.parentdesignations.destroy',
          ),
          1 => 
          array (
            0 => 'parentdesignation',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1858 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.show',
          ),
          1 => 
          array (
            0 => 'gatepass_purpose',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1872 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.edit',
          ),
          1 => 
          array (
            0 => 'gatepass_purpose',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1881 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.update',
          ),
          1 => 
          array (
            0 => 'gatepass_purpose',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_purpose.destroy',
          ),
          1 => 
          array (
            0 => 'gatepass_purpose',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1909 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.show',
          ),
          1 => 
          array (
            0 => 'gatepass_reason',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1923 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.edit',
          ),
          1 => 
          array (
            0 => 'gatepass_reason',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1932 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.update',
          ),
          1 => 
          array (
            0 => 'gatepass_reason',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.setup.gatepass_reason.destroy',
          ),
          1 => 
          array (
            0 => 'gatepass_reason',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1977 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.show',
          ),
          1 => 
          array (
            0 => 'hr_setting',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1991 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.edit',
          ),
          1 => 
          array (
            0 => 'hr_setting',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2000 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.update',
          ),
          1 => 
          array (
            0 => 'hr_setting',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.hr-settings.destroy',
          ),
          1 => 
          array (
            0 => 'hr_setting',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2038 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.show',
          ),
          1 => 
          array (
            0 => 'forward_approve',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2052 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.edit',
          ),
          1 => 
          array (
            0 => 'forward_approve',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2061 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.update',
          ),
          1 => 
          array (
            0 => 'forward_approve',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.settings.forward-approve.destroy',
          ),
          1 => 
          array (
            0 => 'forward_approve',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2112 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.show',
          ),
          1 => 
          array (
            0 => 'new_applicant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2126 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.edit',
          ),
          1 => 
          array (
            0 => 'new_applicant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2135 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.update',
          ),
          1 => 
          array (
            0 => 'new_applicant',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.new-applicants.destroy',
          ),
          1 => 
          array (
            0 => 'new_applicant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2181 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.show',
          ),
          1 => 
          array (
            0 => 'employee_idassign',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2195 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.edit',
          ),
          1 => 
          array (
            0 => 'employee_idassign',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2204 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.update',
          ),
          1 => 
          array (
            0 => 'employee_idassign',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-idassign.destroy',
          ),
          1 => 
          array (
            0 => 'employee_idassign',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2238 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.show',
          ),
          1 => 
          array (
            0 => 'employee_education',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2252 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.edit',
          ),
          1 => 
          array (
            0 => 'employee_education',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2261 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.update',
          ),
          1 => 
          array (
            0 => 'employee_education',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-education.destroy',
          ),
          1 => 
          array (
            0 => 'employee_education',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2292 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.show',
          ),
          1 => 
          array (
            0 => 'employee_experience',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2306 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.edit',
          ),
          1 => 
          array (
            0 => 'employee_experience',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2315 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.update',
          ),
          1 => 
          array (
            0 => 'employee_experience',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-experience.destroy',
          ),
          1 => 
          array (
            0 => 'employee_experience',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2346 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.show',
          ),
          1 => 
          array (
            0 => 'employee_training',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2360 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.edit',
          ),
          1 => 
          array (
            0 => 'employee_training',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2369 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.update',
          ),
          1 => 
          array (
            0 => 'employee_training',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-training.destroy',
          ),
          1 => 
          array (
            0 => 'employee_training',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2400 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.show',
          ),
          1 => 
          array (
            0 => 'employee_reference',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2414 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.edit',
          ),
          1 => 
          array (
            0 => 'employee_reference',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2423 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.update',
          ),
          1 => 
          array (
            0 => 'employee_reference',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-reference.destroy',
          ),
          1 => 
          array (
            0 => 'employee_reference',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2452 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.show',
          ),
          1 => 
          array (
            0 => 'employee_service',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2466 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.edit',
          ),
          1 => 
          array (
            0 => 'employee_service',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2475 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.update',
          ),
          1 => 
          array (
            0 => 'employee_service',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee-service.destroy',
          ),
          1 => 
          array (
            0 => 'employee_service',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2498 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.show',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2512 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.edit',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2521 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.update',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.destroy',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2555 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.getGrade',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2580 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.database.employee.getThana',
          ),
          1 => 
          array (
            0 => 'district_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2628 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.show',
          ),
          1 => 
          array (
            0 => 'employee_listing',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2642 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.edit',
          ),
          1 => 
          array (
            0 => 'employee_listing',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2651 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.update',
          ),
          1 => 
          array (
            0 => 'employee_listing',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'hris.report.employee-listings.destroy',
          ),
          1 => 
          array (
            0 => 'employee_listing',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2687 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.show',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2701 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.edit',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2710 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.update',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.destroy',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2751 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.show',
          ),
          1 => 
          array (
            0 => 'party',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2765 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.edit',
          ),
          1 => 
          array (
            0 => 'party',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2774 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.update',
          ),
          1 => 
          array (
            0 => 'party',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.parties.destroy',
          ),
          1 => 
          array (
            0 => 'party',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2812 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.show',
          ),
          1 => 
          array (
            0 => 'productcategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2826 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.edit',
          ),
          1 => 
          array (
            0 => 'productcategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2835 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.update',
          ),
          1 => 
          array (
            0 => 'productcategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.productcategories.destroy',
          ),
          1 => 
          array (
            0 => 'productcategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2874 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.show',
          ),
          1 => 
          array (
            0 => 'storetype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2888 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.edit',
          ),
          1 => 
          array (
            0 => 'storetype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2897 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.update',
          ),
          1 => 
          array (
            0 => 'storetype',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storetypes.destroy',
          ),
          1 => 
          array (
            0 => 'storetype',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2927 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.show',
          ),
          1 => 
          array (
            0 => 'storeline',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2941 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.edit',
          ),
          1 => 
          array (
            0 => 'storeline',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2950 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.update',
          ),
          1 => 
          array (
            0 => 'storeline',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelines.destroy',
          ),
          1 => 
          array (
            0 => 'storeline',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2980 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.show',
          ),
          1 => 
          array (
            0 => 'storelocation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2994 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.edit',
          ),
          1 => 
          array (
            0 => 'storelocation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3003 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.update',
          ),
          1 => 
          array (
            0 => 'storelocation',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.storelocations.destroy',
          ),
          1 => 
          array (
            0 => 'storelocation',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3042 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.show',
          ),
          1 => 
          array (
            0 => 'suppliertype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3056 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.edit',
          ),
          1 => 
          array (
            0 => 'suppliertype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3065 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.update',
          ),
          1 => 
          array (
            0 => 'suppliertype',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliertypes.destroy',
          ),
          1 => 
          array (
            0 => 'suppliertype',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3088 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.show',
          ),
          1 => 
          array (
            0 => 'supplier',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3102 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.edit',
          ),
          1 => 
          array (
            0 => 'supplier',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3111 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.update',
          ),
          1 => 
          array (
            0 => 'supplier',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.suppliers.destroy',
          ),
          1 => 
          array (
            0 => 'supplier',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3146 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.show',
          ),
          1 => 
          array (
            0 => 'sizegroup',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3160 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.edit',
          ),
          1 => 
          array (
            0 => 'sizegroup',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3169 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.update',
          ),
          1 => 
          array (
            0 => 'sizegroup',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizegroups.destroy',
          ),
          1 => 
          array (
            0 => 'sizegroup',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.show',
          ),
          1 => 
          array (
            0 => 'size',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3206 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.edit',
          ),
          1 => 
          array (
            0 => 'size',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3215 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.update',
          ),
          1 => 
          array (
            0 => 'size',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.sizes.destroy',
          ),
          1 => 
          array (
            0 => 'size',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3252 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.show',
          ),
          1 => 
          array (
            0 => 'racklocation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3266 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.edit',
          ),
          1 => 
          array (
            0 => 'racklocation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.update',
          ),
          1 => 
          array (
            0 => 'racklocation',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.racklocations.destroy',
          ),
          1 => 
          array (
            0 => 'racklocation',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3315 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.show',
          ),
          1 => 
          array (
            0 => 'challanpurpose',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3329 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.edit',
          ),
          1 => 
          array (
            0 => 'challanpurpose',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3338 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.update',
          ),
          1 => 
          array (
            0 => 'challanpurpose',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.challanpurposes.destroy',
          ),
          1 => 
          array (
            0 => 'challanpurpose',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3371 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.show',
          ),
          1 => 
          array (
            0 => 'country',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3385 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.edit',
          ),
          1 => 
          array (
            0 => 'country',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3394 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.update',
          ),
          1 => 
          array (
            0 => 'country',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.countries.destroy',
          ),
          1 => 
          array (
            0 => 'country',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3428 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.show',
          ),
          1 => 
          array (
            0 => 'colorgroup',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3442 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.edit',
          ),
          1 => 
          array (
            0 => 'colorgroup',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3451 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.update',
          ),
          1 => 
          array (
            0 => 'colorgroup',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colorgroups.destroy',
          ),
          1 => 
          array (
            0 => 'colorgroup',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3474 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.show',
          ),
          1 => 
          array (
            0 => 'color',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3488 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.edit',
          ),
          1 => 
          array (
            0 => 'color',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3497 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.update',
          ),
          1 => 
          array (
            0 => 'color',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.colors.destroy',
          ),
          1 => 
          array (
            0 => 'color',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3530 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.show',
          ),
          1 => 
          array (
            0 => 'composition',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3544 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.edit',
          ),
          1 => 
          array (
            0 => 'composition',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3553 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.update',
          ),
          1 => 
          array (
            0 => 'composition',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.compositions.destroy',
          ),
          1 => 
          array (
            0 => 'composition',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3595 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.show',
          ),
          1 => 
          array (
            0 => 'goodscategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3609 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.edit',
          ),
          1 => 
          array (
            0 => 'goodscategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3618 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.update',
          ),
          1 => 
          array (
            0 => 'goodscategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodscategories.destroy',
          ),
          1 => 
          array (
            0 => 'goodscategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3653 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.show',
          ),
          1 => 
          array (
            0 => 'goodsSubCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3667 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.edit',
          ),
          1 => 
          array (
            0 => 'goodsSubCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3676 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.update',
          ),
          1 => 
          array (
            0 => 'goodsSubCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.goodsSubCategories.destroy',
          ),
          1 => 
          array (
            0 => 'goodsSubCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3705 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.show',
          ),
          1 => 
          array (
            0 => 'buyer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3719 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.edit',
          ),
          1 => 
          array (
            0 => 'buyer',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3728 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.update',
          ),
          1 => 
          array (
            0 => 'buyer',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.buyers.destroy',
          ),
          1 => 
          array (
            0 => 'buyer',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3755 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.show',
          ),
          1 => 
          array (
            0 => 'item',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3769 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.edit',
          ),
          1 => 
          array (
            0 => 'item',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3778 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.update',
          ),
          1 => 
          array (
            0 => 'item',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.items.destroy',
          ),
          1 => 
          array (
            0 => 'item',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3810 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.show',
          ),
          1 => 
          array (
            0 => 'yarncount',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3824 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.edit',
          ),
          1 => 
          array (
            0 => 'yarncount',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3833 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.update',
          ),
          1 => 
          array (
            0 => 'yarncount',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.yarncounts.destroy',
          ),
          1 => 
          array (
            0 => 'yarncount',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3868 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.show',
          ),
          1 => 
          array (
            0 => 'fabictype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3882 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.edit',
          ),
          1 => 
          array (
            0 => 'fabictype',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3891 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.update',
          ),
          1 => 
          array (
            0 => 'fabictype',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictypes.destroy',
          ),
          1 => 
          array (
            0 => 'fabictype',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3922 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.show',
          ),
          1 => 
          array (
            0 => 'fabictreatment',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3936 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.edit',
          ),
          1 => 
          array (
            0 => 'fabictreatment',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3945 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.update',
          ),
          1 => 
          array (
            0 => 'fabictreatment',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.setup.fabictreatments.destroy',
          ),
          1 => 
          array (
            0 => 'fabictreatment',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3989 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.show',
          ),
          1 => 
          array (
            0 => 'basicorder',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4003 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.edit',
          ),
          1 => 
          array (
            0 => 'basicorder',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4012 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.update',
          ),
          1 => 
          array (
            0 => 'basicorder',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'inventory.database.basicorders.destroy',
          ),
          1 => 
          array (
            0 => 'basicorder',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4043 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.show',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4057 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.edit',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4066 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.update',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'payroll.destroy',
          ),
          1 => 
          array (
            0 => 'payroll',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4089 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'debugbar.openhandler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/open',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'as' => 'debugbar.openhandler',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.clockwork' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/clockwork/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'as' => 'debugbar.clockwork',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.css' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/stylesheets',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'as' => 'debugbar.assets.css',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.js' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/javascript',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'as' => 'debugbar.assets.js',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.cache.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => '_debugbar/cache/{key}/{tags?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'as' => 'debugbar.cache.delete',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.queries.explain' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_debugbar/queries/explain',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'as' => 'debugbar.queries.explain',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OdXMfhnKB5cDsjhH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:840:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'D:\\\\laragon\\\\www\\\\new erp\\\\garments_erp\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000bcc0000000000000000";}}',
        'as' => 'generated::OdXMfhnKB5cDsjhH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@home',
        'controller' => 'App\\Http\\Controllers\\HomeController@home',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@dashboard',
        'controller' => 'App\\Http\\Controllers\\HomeController@dashboard',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.profile.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\ProfileController@edit',
        'controller' => 'App\\Http\\Controllers\\ProfileController@edit',
        'as' => 'user.profile.edit',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'user/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\ProfileController@update',
        'as' => 'user.profile.update',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.profile.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'user/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\ProfileController@destroy',
        'controller' => 'App\\Http\\Controllers\\ProfileController@destroy',
        'as' => 'user.profile.destroy',
        'namespace' => NULL,
        'prefix' => '/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y5aGiMMkaVPTm3wH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Y5aGiMMkaVPTm3wH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset-password/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\EmailVerificationPromptController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\EmailVerificationPromptController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.notice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email/{id}/{hash}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'signed',
          3 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.send' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'email/verification-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\EmailVerificationNotificationController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\EmailVerificationNotificationController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.send',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@show',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QqQyU8cpNALpCtpX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QqQyU8cpNALpCtpX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordController@update',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\AdministrationController@index',
        'controller' => 'App\\Http\\Controllers\\Administration\\AdministrationController@index',
        'as' => 'administration.index',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/module/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@toggleStatus',
        'as' => 'administration.module.toggle',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/module/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@destroy',
        'as' => 'administration.module.delete',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/modules',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.index',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@index',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@index',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/modules/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.create',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@create',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@create',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/modules',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.store',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@store',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@store',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/modules/{module}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.show',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@show',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@show',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/modules/{module}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.edit',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@edit',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@edit',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'administration/modules/{module}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.update',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@update',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@update',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.module.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'administration/modules/{module}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.module.destroy',
        'uses' => 'App\\Http\\Controllers\\Administration\\ModuleController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\ModuleController@destroy',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.parents' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/menu/{id}/parents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@getMenuParents',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@getMenuParents',
        'as' => 'administration.menu.parents',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.childs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/menu/{id}/childs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@getMenuChilds',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@getMenuChilds',
        'as' => 'administration.menu.childs',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/menu/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@toggleStatus',
        'as' => 'administration.menu.toggle',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/menu/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@destroy',
        'as' => 'administration.menu.delete',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/menus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.index',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@index',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@index',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/menus/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.create',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@create',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@create',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/menus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.store',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@store',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@store',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/menus/{menu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.show',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@show',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@show',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/menus/{menu}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.edit',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@edit',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@edit',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'administration/menus/{menu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.update',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@update',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@update',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.menu.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'administration/menus/{menu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.menu.destroy',
        'uses' => 'App\\Http\\Controllers\\Administration\\MenuController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\MenuController@destroy',
        'namespace' => NULL,
        'prefix' => '/administration',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/permission/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@destroy',
        'as' => 'administration.authorization.permission.delete',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/permission/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@toggleStatus',
        'as' => 'administration.authorization.permission.toggle',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.index',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@index',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@index',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/permissions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.create',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@create',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@create',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.store',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@store',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@store',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/permissions/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.show',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@show',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@show',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/permissions/{permission}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.edit',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@edit',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@edit',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'administration/authorization/permissions/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.update',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@update',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@update',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.permission.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'administration/authorization/permissions/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.permission.destroy',
        'uses' => 'App\\Http\\Controllers\\Administration\\PermissionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\PermissionController@destroy',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/role/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@destroy',
        'as' => 'administration.authorization.role.delete',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/role/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@toggleStatus',
        'as' => 'administration.authorization.role.toggle',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.index',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@index',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@index',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/roles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.create',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@create',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@create',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.store',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@store',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@store',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.show',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@show',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@show',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/roles/{role}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.edit',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@edit',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@edit',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'administration/authorization/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.update',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@update',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@update',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.role.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'administration/authorization/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.role.destroy',
        'uses' => 'App\\Http\\Controllers\\Administration\\RoleController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\RoleController@destroy',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/user/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@destroy',
        'as' => 'administration.authorization.user.delete',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/user/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@toggleStatus',
        'as' => 'administration.authorization.user.toggle',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.index',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@index',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/users/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.create',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@create',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'administration/authorization/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.store',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@store',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.show',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@show',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration/authorization/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.edit',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@edit',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'administration/authorization/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.update',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@update',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'administration.authorization.user.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'administration/authorization/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:administration',
        ),
        'as' => 'administration.authorization.user.destroy',
        'uses' => 'App\\Http\\Controllers\\Administration\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Administration\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => 'administration/authorization',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Master\\MasterController@index',
        'controller' => 'App\\Http\\Controllers\\Master\\MasterController@index',
        'as' => 'master.index',
        'namespace' => NULL,
        'prefix' => '/master',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.system-settings.general-settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master/system-settings/general-settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Master\\SystemSetting\\GeneralSettingController@generalSettings',
        'controller' => 'App\\Http\\Controllers\\Master\\SystemSetting\\GeneralSettingController@generalSettings',
        'as' => 'master.system-settings.general-settings',
        'namespace' => NULL,
        'prefix' => 'master/system-settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.system-settings.general-settings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master/system-settings/general-settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Master\\SystemSetting\\GeneralSettingController@generalSettingsStore',
        'controller' => 'App\\Http\\Controllers\\Master\\SystemSetting\\GeneralSettingController@generalSettingsStore',
        'as' => 'master.system-settings.general-settings.store',
        'namespace' => NULL,
        'prefix' => 'master/system-settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.units.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master/setup/units/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@destroy',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@destroy',
        'as' => 'master.setup.units.delete',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.units.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master/setup/units/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@toggleStatus',
        'as' => 'master.setup.units.toggle',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master/setup/units',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.index',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@index',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@index',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master/setup/units/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.create',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@create',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@create',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master/setup/units',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.store',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@store',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@store',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master/setup/units/{unit}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.show',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@show',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@show',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master/setup/units/{unit}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.edit',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@edit',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@edit',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'master/setup/units/{unit}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.update',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@update',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@update',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'master.setup.unit.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'master/setup/units/{unit}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'as' => 'master.setup.unit.destroy',
        'uses' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@destroy',
        'controller' => 'App\\Http\\Controllers\\Master\\Setup\\UnitsController@destroy',
        'namespace' => NULL,
        'prefix' => 'master/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.hris.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/hris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.hris.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@index',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.hris.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/hris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.hris.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@store',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.hris.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/hris/{hri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.hris.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@show',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.hris.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'api/v1/hris/{hri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.hris.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@update',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.hris.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/hris/{hri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.hris.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@destroy',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/{hri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/{hri}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/{hri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/{hri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\HRISController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/nationalities/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@toggleStatus',
        'as' => 'hris.setup.nationalities.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/nationalities/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@destroy',
        'as' => 'hris.setup.nationalities.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/nationalities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/nationalities/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/nationalities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/nationalities/{nationality}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/nationalities/{nationality}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/nationalities/{nationality}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.nationalities.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/nationalities/{nationality}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.nationalities.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\NationalitiesController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/maritalstatus/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@toggleStatus',
        'as' => 'hris.setup.maritalstatus.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/maritalstatus/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@destroy',
        'as' => 'hris.setup.maritalstatus.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/maritalstatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/maritalstatus/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/maritalstatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/maritalstatus/{maritalstatus}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/maritalstatus/{maritalstatus}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/maritalstatus/{maritalstatus}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.maritalstatus.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/maritalstatus/{maritalstatus}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.maritalstatus.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\MaritalStatusController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/sex/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@toggleStatus',
        'as' => 'hris.setup.sex.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/sex/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@destroy',
        'as' => 'hris.setup.sex.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sex',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sex/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/sex',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sex/{sex}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sex/{sex}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/sex/{sex}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sex.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/sex/{sex}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sex.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SexController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/religions/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@toggleStatus',
        'as' => 'hris.setup.religions.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/religions/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@destroy',
        'as' => 'hris.setup.religions.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/religions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/religions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/religions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/religions/{religion}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/religions/{religion}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/religions/{religion}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.religions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/religions/{religion}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.religions.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ReligionController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/divisions/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@toggleStatus',
        'as' => 'hris.setup.divisions.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/divisions/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@destroy',
        'as' => 'hris.setup.divisions.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/divisions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/divisions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/divisions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/divisions/{division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/divisions/{division}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/divisions/{division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.divisions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/divisions/{division}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.divisions.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DivisionController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/districts/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@toggleStatus',
        'as' => 'hris.setup.districts.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/districts/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@destroy',
        'as' => 'hris.setup.districts.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/districts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/districts/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/districts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/districts/{district}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/districts/{district}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/districts/{district}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.districts.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/districts/{district}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.districts.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DistrictController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/thanas/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@toggleStatus',
        'as' => 'hris.setup.thanas.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/thanas/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@destroy',
        'as' => 'hris.setup.thanas.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/thanas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/thanas/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/thanas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/thanas/{thana}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/thanas/{thana}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/thanas/{thana}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.thanas.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/thanas/{thana}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.thanas.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ThanaController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/unions/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@toggleStatus',
        'as' => 'hris.setup.unions.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/unions/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@destroy',
        'as' => 'hris.setup.unions.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/unions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/unions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/unions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/unions/{union}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/unions/{union}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/unions/{union}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.unions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/unions/{union}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.unions.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\UnionController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/educationboards/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@toggleStatus',
        'as' => 'hris.setup.educationboards.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/educationboards/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@destroy',
        'as' => 'hris.setup.educationboards.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/educationboards',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/educationboards/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/educationboards',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/educationboards/{educationboard}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/educationboards/{educationboard}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/educationboards/{educationboard}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.educationboards.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/educationboards/{educationboard}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.educationboards.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EducationBoardController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/documents/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@toggleStatus',
        'as' => 'hris.setup.documents.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/documents/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@destroy',
        'as' => 'hris.setup.documents.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/documents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/documents/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/documents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/documents/{document}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/documents/{document}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/documents/{document}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.documents.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/documents/{document}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.documents.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DocumentController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/sourcereferences/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@toggleStatus',
        'as' => 'hris.setup.sourcereferences.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/sourcereferences/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@destroy',
        'as' => 'hris.setup.sourcereferences.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sourcereferences',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sourcereferences/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/sourcereferences',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sourcereferences/{sourcereference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/sourcereferences/{sourcereference}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/sourcereferences/{sourcereference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.sourcereferences.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/sourcereferences/{sourcereference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.sourcereferences.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\SourceReferenceController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/employeecategories/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@toggleStatus',
        'as' => 'hris.setup.employeecategories.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/employeecategories/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@destroy',
        'as' => 'hris.setup.employeecategories.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/employeecategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/employeecategories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/employeecategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/employeecategories/{employeecategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/employeecategories/{employeecategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/employeecategories/{employeecategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.employeecategories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/employeecategories/{employeecategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.employeecategories.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmployeeCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/organizations/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@toggleStatus',
        'as' => 'hris.setup.organizations.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/organizations/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@destroy',
        'as' => 'hris.setup.organizations.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/organizations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/organizations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/organizations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/organizations/{organization}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/organizations/{organization}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/organizations/{organization}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.organizations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/organizations/{organization}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.organizations.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\OrganizationController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/shifts/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@toggleStatus',
        'as' => 'hris.setup.shifts.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/shifts/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@destroy',
        'as' => 'hris.setup.shifts.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/shifts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/shifts/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/shifts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/shifts/{shift}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/shifts/{shift}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/shifts/{shift}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.shifts.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/shifts/{shift}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.shifts.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ShiftController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/leaveclassifications/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@toggleStatus',
        'as' => 'hris.setup.leaveclassifications.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/leaveclassifications/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@destroy',
        'as' => 'hris.setup.leaveclassifications.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/leaveclassifications',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/leaveclassifications/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/leaveclassifications',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/leaveclassifications/{leaveclassification}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/leaveclassifications/{leaveclassification}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/leaveclassifications/{leaveclassification}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.leaveclassifications.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/leaveclassifications/{leaveclassification}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.leaveclassifications.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\LeaveClassificationController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/parentdepartments/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@toggleStatus',
        'as' => 'hris.setup.parentdepartments.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/parentdepartments/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@destroy',
        'as' => 'hris.setup.parentdepartments.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdepartments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdepartments/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/parentdepartments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdepartments/{parentdepartment}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdepartments/{parentdepartment}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/parentdepartments/{parentdepartment}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdepartments.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/parentdepartments/{parentdepartment}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdepartments.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDepartmentController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/parentdesignations/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@toggleStatus',
        'as' => 'hris.setup.parentdesignations.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/parentdesignations/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@destroy',
        'as' => 'hris.setup.parentdesignations.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdesignations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdesignations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/parentdesignations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdesignations/{parentdesignation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/parentdesignations/{parentdesignation}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/parentdesignations/{parentdesignation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.parentdesignations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/parentdesignations/{parentdesignation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.parentdesignations.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\ParentDesignationController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/departments/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@toggleStatus',
        'as' => 'hris.setup.departments.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/departments/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@destroy',
        'as' => 'hris.setup.departments.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/departments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/departments/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/departments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/departments/{department}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/departments/{department}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/departments/{department}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.departments.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/departments/{department}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.departments.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DepartmentController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/designations/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@toggleStatus',
        'as' => 'hris.setup.designations.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/designations/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@destroy',
        'as' => 'hris.setup.designations.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/designations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/designations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/designations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/designations/{designation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/designations/{designation}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/designations/{designation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.designations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/designations/{designation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.designations.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DesignationController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/degrees/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@toggleStatus',
        'as' => 'hris.setup.degrees.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/degrees/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@destroy',
        'as' => 'hris.setup.degrees.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/degrees',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/degrees/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/degrees',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/degrees/{degree}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/degrees/{degree}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/degrees/{degree}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.degrees.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/degrees/{degree}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.degrees.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\DegreeController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/gatepass_purpose/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@toggleStatus',
        'as' => 'hris.setup.gatepass_purpose.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/gatepass_purpose/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@destroy',
        'as' => 'hris.setup.gatepass_purpose.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_purpose',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_purpose/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/gatepass_purpose',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_purpose/{gatepass_purpose}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_purpose/{gatepass_purpose}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/gatepass_purpose/{gatepass_purpose}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_purpose.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/gatepass_purpose/{gatepass_purpose}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_purpose.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassPurposeController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/gatepass_reason/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@toggleStatus',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@toggleStatus',
        'as' => 'hris.setup.gatepass_reason.toggle',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/gatepass_reason/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@destroy',
        'as' => 'hris.setup.gatepass_reason.delete',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_reason',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@index',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_reason/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@create',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/setup/gatepass_reason',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@store',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_reason/{gatepass_reason}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@show',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/setup/gatepass_reason/{gatepass_reason}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/setup/gatepass_reason/{gatepass_reason}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@update',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.setup.gatepass_reason.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/setup/gatepass_reason/{gatepass_reason}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.setup.gatepass_reason.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Setup\\EmpGatepassReasonController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.search' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/new-applicants/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@getSearch',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@getSearch',
        'as' => 'hris.database.new-applicants.search',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/new-applicants/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@destroy',
        'as' => 'hris.database.new-applicants.delete',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/new-applicants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/new-applicants/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/new-applicants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/new-applicants/{new_applicant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/new-applicants/{new_applicant}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/new-applicants/{new_applicant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.new-applicants.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/new-applicants/{new_applicant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.new-applicants.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\ApplicantController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-idassign',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-idassign/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-idassign',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-idassign/{employee_idassign}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-idassign/{employee_idassign}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee-idassign/{employee_idassign}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-idassign.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee-idassign/{employee_idassign}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-idassign.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeIDAssignController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.getGrade' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/designation/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@getGrade',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@getGrade',
        'as' => 'hris.database.employee.getGrade',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.getThana' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/district/{district_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@getThana',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@getThana',
        'as' => 'hris.database.employee.getThana',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.search' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@getSearch',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@getSearch',
        'as' => 'hris.database.employee.search',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.bangla' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee/bangla',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeeBangla',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeeBangla',
        'as' => 'hris.database.employee.bangla',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.salary' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee/salary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeeSalary',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeeSalary',
        'as' => 'hris.database.employee.salary',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.personal' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee/personal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeePersonal',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeePersonal',
        'as' => 'hris.database.employee.personal',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.document' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee/document',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeeDocument',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@storeEmployeeDocument',
        'as' => 'hris.database.employee.document',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee/{employee}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee/{employee}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee/{employee}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee/{employee}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-education/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@destroy',
        'as' => 'hris.database.employee-education.delete',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-education',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-education/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-education',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-education/{employee_education}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-education/{employee_education}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee-education/{employee_education}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-education.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee-education/{employee_education}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-education.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeEducationController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-training/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@destroy',
        'as' => 'hris.database.employee-training.delete',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-training',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-training/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-training',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-training/{employee_training}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-training/{employee_training}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee-training/{employee_training}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-training.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee-training/{employee_training}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-training.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeTrainingController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-experience/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@destroy',
        'as' => 'hris.database.employee-experience.delete',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-experience',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-experience/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-experience',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-experience/{employee_experience}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-experience/{employee_experience}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee-experience/{employee_experience}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-experience.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee-experience/{employee_experience}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-experience.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeExperienceController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-reference/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@destroy',
        'as' => 'hris.database.employee-reference.delete',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-reference',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-reference/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-reference',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-reference/{employee_reference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-reference/{employee_reference}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee-reference/{employee_reference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-reference.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee-reference/{employee_reference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-reference.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeReferenceController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-service/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@destroy',
        'as' => 'hris.database.employee-service.delete',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-service',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@index',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-service/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@create',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/database/employee-service',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@store',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-service/{employee_service}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@show',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/database/employee-service/{employee_service}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/database/employee-service/{employee_service}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@update',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.database.employee-service.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/database/employee-service/{employee_service}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.database.employee-service.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Database\\EmployeeServiceController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.preview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/report/employee-listings/preview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@previewData',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@previewData',
        'as' => 'hris.report.employee-listings.preview',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/report/employee-listings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@index',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/report/employee-listings/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@create',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/report/employee-listings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@store',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/report/employee-listings/{employee_listing}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@show',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/report/employee-listings/{employee_listing}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/report/employee-listings/{employee_listing}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@update',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.report.employee-listings.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/report/employee-listings/{employee_listing}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.report.employee-listings.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Report\\EmployeeListingReportController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/report',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/hr-settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@index',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/hr-settings/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@create',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/settings/hr-settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@store',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/hr-settings/{hr_setting}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@show',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/hr-settings/{hr_setting}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/settings/hr-settings/{hr_setting}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@update',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.hr-settings.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/settings/hr-settings/{hr_setting}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.hr-settings.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\SettingController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/forward-approve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.index',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@index',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@index',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/forward-approve/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.create',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@create',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@create',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hris/settings/forward-approve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.store',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@store',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@store',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/forward-approve/{forward_approve}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.show',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@show',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@show',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hris/settings/forward-approve/{forward_approve}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.edit',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@edit',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@edit',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'hris/settings/forward-approve/{forward_approve}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.update',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@update',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@update',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'hris.settings.forward-approve.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'hris/settings/forward-approve/{forward_approve}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:hris',
        ),
        'as' => 'hris.settings.forward-approve.destroy',
        'uses' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@destroy',
        'controller' => 'Modules\\HRIS\\Http\\Controllers\\Settings\\ForwardApproveController@destroy',
        'namespace' => NULL,
        'prefix' => 'hris/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.inventory.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/inventories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.inventory.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@index',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.inventory.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/inventories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.inventory.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@store',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.inventory.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/inventories/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.inventory.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@show',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.inventory.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'api/v1/inventories/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.inventory.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@update',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.inventory.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/inventories/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.inventory.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/{inventory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/parties/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@toggleStatus',
        'as' => 'inventory.setup.parties.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/parties/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'as' => 'inventory.setup.parties.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/parties',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/parties/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/parties',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/parties/{party}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/parties/{party}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/parties/{party}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.parties.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/parties/{party}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.parties.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\InventoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storetypes/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@toggleStatus',
        'as' => 'inventory.setup.storetypes.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storetypes/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@destroy',
        'as' => 'inventory.setup.storetypes.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storetypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storetypes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storetypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storetypes/{storetype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storetypes/{storetype}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/storetypes/{storetype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storetypes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/storetypes/{storetype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storetypes.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreTypeController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storelines/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@toggleStatus',
        'as' => 'inventory.setup.storelines.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storelines/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@destroy',
        'as' => 'inventory.setup.storelines.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelines/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storelines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelines/{storeline}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelines/{storeline}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/storelines/{storeline}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelines.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/storelines/{storeline}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelines.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLineController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/racklocations/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@toggleStatus',
        'as' => 'inventory.setup.racklocations.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/racklocations/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@destroy',
        'as' => 'inventory.setup.racklocations.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/racklocations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/racklocations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/racklocations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/racklocations/{racklocation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/racklocations/{racklocation}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/racklocations/{racklocation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.racklocations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/racklocations/{racklocation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.racklocations.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\RackLocationController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storelocations/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@toggleStatus',
        'as' => 'inventory.setup.storelocations.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storelocations/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@destroy',
        'as' => 'inventory.setup.storelocations.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelocations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelocations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/storelocations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelocations/{storelocation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/storelocations/{storelocation}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/storelocations/{storelocation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.storelocations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/storelocations/{storelocation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.storelocations.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\StoreLocationController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/suppliertypes/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@toggleStatus',
        'as' => 'inventory.setup.suppliertypes.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/suppliertypes/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@destroy',
        'as' => 'inventory.setup.suppliertypes.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliertypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliertypes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/suppliertypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliertypes/{suppliertype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliertypes/{suppliertype}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/suppliertypes/{suppliertype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliertypes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/suppliertypes/{suppliertype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliertypes.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierTypeController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/suppliers/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@toggleStatus',
        'as' => 'inventory.setup.suppliers.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/suppliers/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@destroy',
        'as' => 'inventory.setup.suppliers.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliers/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/suppliers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliers/{supplier}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/suppliers/{supplier}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/suppliers/{supplier}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.suppliers.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/suppliers/{supplier}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.suppliers.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SupplierController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/challanpurposes/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@toggleStatus',
        'as' => 'inventory.setup.challanpurposes.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/challanpurposes/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@destroy',
        'as' => 'inventory.setup.challanpurposes.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/challanpurposes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/challanpurposes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/challanpurposes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/challanpurposes/{challanpurpose}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/challanpurposes/{challanpurpose}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/challanpurposes/{challanpurpose}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.challanpurposes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/challanpurposes/{challanpurpose}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.challanpurposes.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ChallanPurposeController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/goodscategories/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@toggleStatus',
        'as' => 'inventory.setup.goodscategories.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/goodscategories/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@destroy',
        'as' => 'inventory.setup.goodscategories.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodscategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodscategories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/goodscategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodscategories/{goodscategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodscategories/{goodscategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/goodscategories/{goodscategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodscategories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/goodscategories/{goodscategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodscategories.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@toggleStatus',
        'as' => 'inventory.setup.goodsSubCategories.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@destroy',
        'as' => 'inventory.setup.goodsSubCategories.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodsSubCategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/goodsSubCategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/{goodsSubCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/{goodsSubCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/{goodsSubCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.goodsSubCategories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/goodsSubCategories/{goodsSubCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.goodsSubCategories.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\GoodsSubCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/countries/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@toggleStatus',
        'as' => 'inventory.setup.countries.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/countries/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@destroy',
        'as' => 'inventory.setup.countries.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/countries',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/countries/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/countries',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/countries/{country}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/countries/{country}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/countries/{country}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.countries.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/countries/{country}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.countries.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CountryController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/colorgroups/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@toggleStatus',
        'as' => 'inventory.setup.colorgroups.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/colorgroups/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@destroy',
        'as' => 'inventory.setup.colorgroups.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colorgroups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colorgroups/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/colorgroups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colorgroups/{colorgroup}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colorgroups/{colorgroup}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/colorgroups/{colorgroup}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colorgroups.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/colorgroups/{colorgroup}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colorgroups.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorGroupController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/colors/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@toggleStatus',
        'as' => 'inventory.setup.colors.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/colors/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@destroy',
        'as' => 'inventory.setup.colors.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colors',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colors/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/colors',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colors/{color}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/colors/{color}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/colors/{color}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.colors.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/colors/{color}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.colors.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ColorController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/sizegroups/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@toggleStatus',
        'as' => 'inventory.setup.sizegroups.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/sizegroups/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@destroy',
        'as' => 'inventory.setup.sizegroups.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizegroups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizegroups/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/sizegroups',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizegroups/{sizegroup}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizegroups/{sizegroup}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/sizegroups/{sizegroup}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizegroups.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/sizegroups/{sizegroup}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizegroups.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeGroupController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/sizes/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@toggleStatus',
        'as' => 'inventory.setup.sizes.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/sizes/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@destroy',
        'as' => 'inventory.setup.sizes.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/sizes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizes/{size}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/sizes/{size}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/sizes/{size}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.sizes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/sizes/{size}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.sizes.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\SizeController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/buyers/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@toggleStatus',
        'as' => 'inventory.setup.buyers.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/buyers/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@destroy',
        'as' => 'inventory.setup.buyers.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/buyers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/buyers/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/buyers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/buyers/{buyer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/buyers/{buyer}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/buyers/{buyer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.buyers.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/buyers/{buyer}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.buyers.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\BuyerController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/items/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@toggleStatus',
        'as' => 'inventory.setup.items.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/items/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@destroy',
        'as' => 'inventory.setup.items.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/items/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/items/{item}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/items/{item}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/items/{item}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/items/{item}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.items.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.items.getSubcategories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/inventory/setup/items/get-subcategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@getSubcategories',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ItemController@getSubcategories',
        'as' => 'inventory.setup.items.getSubcategories',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/compositions/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@toggleStatus',
        'as' => 'inventory.setup.compositions.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/compositions/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@destroy',
        'as' => 'inventory.setup.compositions.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/compositions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/compositions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/compositions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/compositions/{composition}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/compositions/{composition}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/compositions/{composition}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.compositions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/compositions/{composition}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.compositions.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\CompositionController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/yarncounts/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@toggleStatus',
        'as' => 'inventory.setup.yarncounts.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/yarncounts/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@destroy',
        'as' => 'inventory.setup.yarncounts.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/yarncounts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/yarncounts/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/yarncounts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/yarncounts/{yarncount}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/yarncounts/{yarncount}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/yarncounts/{yarncount}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.yarncounts.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/yarncounts/{yarncount}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.yarncounts.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\YarnCountController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/fabictypes/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@toggleStatus',
        'as' => 'inventory.setup.fabictypes.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/fabictypes/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@destroy',
        'as' => 'inventory.setup.fabictypes.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictypes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/fabictypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictypes/{fabictype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictypes/{fabictype}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/fabictypes/{fabictype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictypes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/fabictypes/{fabictype}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictypes.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTypeController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/fabictreatments/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@toggleStatus',
        'as' => 'inventory.setup.fabictreatments.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/fabictreatments/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@destroy',
        'as' => 'inventory.setup.fabictreatments.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictreatments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictreatments/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/fabictreatments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictreatments/{fabictreatment}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/fabictreatments/{fabictreatment}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/fabictreatments/{fabictreatment}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.fabictreatments.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/fabictreatments/{fabictreatment}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.fabictreatments.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\FabricTreatmentsController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/productcategories/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@toggleStatus',
        'as' => 'inventory.setup.productcategories.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/productcategories/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@destroy',
        'as' => 'inventory.setup.productcategories.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/productcategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/productcategories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/setup/productcategories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/productcategories/{productcategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/setup/productcategories/{productcategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/setup/productcategories/{productcategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.setup.productcategories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/setup/productcategories/{productcategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.setup.productcategories.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Setup\\ProductCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/setup',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/database/basicorders/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@toggleStatus',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@toggleStatus',
        'as' => 'inventory.database.basicorders.toggle',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/database/basicorders/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@destroy',
        'as' => 'inventory.database.basicorders.delete',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/database/basicorders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.index',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@index',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@index',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/database/basicorders/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.create',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@create',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@create',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inventory/database/basicorders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.store',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@store',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@store',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/database/basicorders/{basicorder}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.show',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@show',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@show',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inventory/database/basicorders/{basicorder}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.edit',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@edit',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@edit',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'inventory/database/basicorders/{basicorder}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.update',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@update',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@update',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inventory.database.basicorders.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'inventory/database/basicorders/{basicorder}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:inventory',
        ),
        'as' => 'inventory.database.basicorders.destroy',
        'uses' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@destroy',
        'controller' => 'Modules\\Inventory\\Http\\Controllers\\Database\\BasicOrderController@destroy',
        'namespace' => NULL,
        'prefix' => 'inventory/database',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.payroll.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/payrolls',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.payroll.index',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@index',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@index',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.payroll.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/payrolls',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.payroll.store',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@store',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@store',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.payroll.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/payrolls/{payroll}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.payroll.show',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@show',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@show',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.payroll.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'api/v1/payrolls/{payroll}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.payroll.update',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@update',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@update',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.payroll.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/payrolls/{payroll}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'as' => 'api.payroll.destroy',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@destroy',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@destroy',
        'namespace' => NULL,
        'prefix' => 'api/v1',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'payroll',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.index',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@index',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'payroll/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.create',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@create',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'payroll',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.store',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@store',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'payroll/{payroll}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.show',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@show',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'payroll/{payroll}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.edit',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@edit',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'payroll/{payroll}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.update',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@update',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payroll.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'payroll/{payroll}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
          3 => 'App\\Http\\Middleware\\ModuleActive:payroll',
        ),
        'as' => 'payroll.destroy',
        'uses' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@destroy',
        'controller' => 'Modules\\Payroll\\Http\\Controllers\\PayrollController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:55:"D:\\laragon\\www\\new erp\\garments_erp\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000e0b0000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
