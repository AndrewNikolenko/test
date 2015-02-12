/*
/--------------------------------
/ Global App View
/--------------------------------
*/
App.Views.App = Backbone.View.extend({
    initialize: function() {
        //var addContact = new App.Views.AddContact({ collection: App.AddContact });
        var addContact = new App.Views.AddContact({ collection: App.contacts });
        var allContacts = new App.Views.Contacts({ collection: App.contacts }).render();
        $('#allContactsTable').append(allContacts.el);
    }
});

/*
/--------------------------------
/ AddContact View
/--------------------------------
*/
App.Views.AddContact = Backbone.View.extend({
    initialize: function() {
        this.first_name = $('#first_name');
        this.last_name = $('#last_name');
        this.email_address = $('#email_address');
        this.description = $('#description');
    },
    
    el: '#contact-form',
    
    events: {
        'submit' : 'addContact'
    },
    
    addContact: function(e) {
        e.preventDefault();
        
        this.collection.create({
            first_name: this.first_name.val(),
            last_name: this.last_name.val(),
            email_address: this.email_address.val(),
            description: this.description.val(),
        }, {wait: true});
        
        this.clearInps();
    },
    
    clearInps: function() {
        this.first_name.val('');
        this.last_name.val('');
        this.email_address.val('');
        this.description.val('');
    }
});
/*
/--------------------------------
/ edit contact View
/--------------------------------
*/

/*
/--------------------------------
/ All contacts View
/--------------------------------
*/
App.Views.Contacts = Backbone.View.extend({
    initialize: function() {
        //App.AddContact.on('add', this.addOne, this);
        this.collection.on('add', this.addOne, this);
    },
    
    tagName: 'tbody',
    
    render: function() {
        this.collection.each(this.addOne, this);
        return this;
    },
    
    addOne: function(contact) {
        var singleContact = new App.Views.Contact({ model: contact });
        console.log(singleContact.render().el);
        this.$el.append(singleContact.render().el);
    }
});

/*
/--------------------------------
/ Single contact View
/--------------------------------
*/
App.Views.Contact = Backbone.View.extend({
    initialize: function() {
        this.model.on('destroy', this.unrender, this);
    },
    
    tagName: 'tr',
    
    events: {
        'click a.delete' : 'removeContact',
        'click a.edit' : 'editContact',
    },
    
    removeContact: function(e) {
        e.preventDefault();
        this.model.destroy();
    },
    
    unrender: function() {
        this.remove();
    },
    
    editContact: function() {
        // Создавать новый экземпляр вида editContactView
        // Привязываем модель к этому виду
        // Добавляем форму в дом дерево
    },
    
    template: _.template('<td><%= first_name %></td><td><%= last_name %></td><td><%= email_address %></td><td><%= description %></td><td><a href="/delete/<%= id %>" class="delete">Удалить</a></td><td><a href="/update/<%= id %>" class="edit">Редактировать</a></td>'),
    
    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});