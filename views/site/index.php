<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Менеджер контактов</h1>
    </div>
    
    <form action="" id="contact-form" method="post">
        <div>
            <label for="first_name">Имя:</label>
            <input type="text" name="first_name" id="first_name"/>
        </div>
        <div>
            <label for="last_name">Фамилия:</label>
            <input type="text" name="last_name" id="last_name"/>
        </div>
        <div>
            <label for="email_address">Email:</label>
            <input type="text" name="email_address" id="email_address"/>
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <input type="submit" value="Добавить контакт"/>
        </div>
    </form>
    
    <table id="allContactsTable">
        <thead>
            <td><strong>Имя</strong></td>
            <td><strong>Фамилия</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Описание</strong></td>
            <td><strong>Действия</strong></td>
        </thead>
    </table>
    
    <script type="text/javascript">
        new App.Router();
        Backbone.history.start();
        
        App.contacts = new App.Collections.Contacts();
        App.contacts.fetch().then(function() {
            new App.Views.App({ collection: App.contacts });
        });
        
        //App.AddContact = new App.Collections.AddContact();
    </script>
</div>