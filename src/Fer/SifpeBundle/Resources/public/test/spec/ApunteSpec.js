/**
 * Created with JetBrains PhpStorm.
 * User: fernando
 * Date: 20/10/13
 * Time: 12:12
 * To change this template use File | Settings | File Templates.
 */
describe('sifpeApp', function(){
    var scope;//we'll use this scope in our tests
    var module;
    beforeEach(function() {
        module = angular.module("sifpeApp");
    });

    it("should be registered", function() {
        expect(module).not.to.equal(null);
    });

});
