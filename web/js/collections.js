App.Collections.Contacts = Backbone.Collection.extend({
    model: App.Models.Contact,
    url: '/contacts'
});

/*App.Collections.AddContact = Backbone.Collection.extend({
    model: App.Models.Contact,
    url: '/add'
});*/