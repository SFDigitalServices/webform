<?php
$env = getenv("APP_ENV");
if(!$env || $env == 'testing')
{
    return array(
        'dsn' => 'https://b53658ff4ec749719da39905217d41e0@sentry.io/1366253',
        'breadcrumbs.sql_bindings' => true,
        'user_context' => false,
    );
}
return array(
    'dsn' => '___DSN___',
    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),
    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => true,
    // Capture default user context
    'user_context' => false,
);