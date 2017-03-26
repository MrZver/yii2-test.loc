Short description
============================

Установка:
- стандартная из композера: composer update
- используется модуль yii2-user его миграции запускаются так: php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
- используется модуль yii2-rbac его миграции запускаются так: php yii migrate/up --migrationPath=@yii/rbac/migrations
- БД разворачивается из миграций: php yii migrate 
- доступно создание ролей: yii myrbac/init
- создание данных:
    - зарегать юзера admin, роли юзерам можно назначать в админке
    - в /admin/informtype создать типы: email, browser
    - создать пару новостей в /news/index
- доступно тестирование codecept run

Структура сайта:
- /site/index - главная с новостями и ссылкой на полную новость
- /site/profile - профиль с настройкой уведомлений
- /news/index - CRUD новостей, с разными уровнями доступа
- /admin - главная страница админки с меню
- /rbac - управление доступом
- /user/admin/index - управление пользователями
- /admin/informtype - управление типами уведомлений
- /admin/user-inform-pref - управление уведомлениями
- /admin/default/instant-inform - немедленная отправка уведомлений

Добавление новых типов уведомлений:
- в админке создать тип в: /admin/informtype
- в компоненте app\components\Inform создать новый метод с логикой для нового типа (название метода должно совпадать с названием типа)

Дополнительная информация:
- Времени затрачено: 3 рабочих дня (24 часа)
- Ссылка на резюме: https://www.dropbox.com/s/gvb8x23vd0fx3c6/%D0%A0%D0%B5%D0%B7%D1%8E%D0%BC%D0%B5%20%D0%BE%D1%82%20%D0%9A%D0%BB%D1%8F%D1%83%D0%B7%20%D0%AE%D1%80%D0%B8%D0%B9.doc?dl=0
