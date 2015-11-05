seanceApp.filter('dateCompare', function() {
  return function (objects, operator) {

    var filtered_list = [];
    var today = new Date().getTime();

    angular.forEach(objects, function(value, key){
       
      var to_compare = new Date(value.date).getTime();
      var add = false;

      switch(operator) {
        case '==':
            add = to_compare == today;
            break;
        case '>':
            add = to_compare > today;
            break;
        case '<':
            add = to_compare < today;
            break;
        case '>=':
            add = to_compare >= today;
            break;
        case '<=':
            add = to_compare <= today;
            break;
        case '!=':
        case '<>':
            add = to_compare != today;
            break;
      }

      if (add) {
        filtered_list.push(value);
      }

    });
    return filtered_list;
  }
});