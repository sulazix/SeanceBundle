seanceApp.filter('searchFilter', function() {
  return function (objects, query, properties) {

    if (!query || query === "") return objects;

    var filtered_list = [];

    angular.forEach(objects, function(value, key){
       
       var add = false;
       angular.forEach(properties, function(property, key) {
        // Try value until a match is found
        if (!add)
          add = angular.lowercase(value[property]).indexOf(angular.lowercase(query)) != -1;
       });
      

      if (add) {
        filtered_list.push(value);
      }

    });
    return filtered_list;
  };
});