List.prototype.plugins.filtering = function(locals, options) {
    var list = this;
    var container = $("#" + list.listContainer.id);
    var init = function() {
        options = options || {};

        container.find('[data-filter="list"]').each(function(){
            var filter = $(this);
            var filterList = $('<ul></ul>');
            filter.prepend(filterList);
            var property = filter.attr("data-filter-property");
            var values = get.values(property).unique();

            var item = $("<li><a class='btn'>Alle</a></li>");
            filterList.append(item);

            for (var i = values.length - 1; i >= 0; i--) {
                var value = values[i];
                var item = $("<li><a class='btn'>"+value+"</a></li>");
                filterList.append(item);
            };
            filter.find('a').click(function() {
                var link = $(this);
                list.filter(function(item) {
                    if (item.values()[property] == link.text() || link.text() == 'Alle') {
                        return true;
                    } else {
                        return false;
                    }
                });
                return false;
            });
        });
    };

    var get = {
        values: function(property){
            var values = [];
            for (var i = list.items.length - 1; i >= 0; i--) {
                var item = list.items[i];
                values.push(item.values()[property]);
            };
            return values;
        }
    }

    Array.prototype.unique = function() {
        var o = {}, i, l = this.length, r = [];
        for(i=0; i<l;i+=1) o[this[i]] = this[i];
        for(i in o) r.push(o[i]);
        return r;
    };

    init();
    return this;
};