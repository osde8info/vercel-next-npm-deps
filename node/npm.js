
function getdeps(pack,ver,callback) {
	var request = require("request");
	ver = ver.replace('^','');
	request("https://registry.npmjs.org/"+pack+"/"+ver,deps=function(error,response,body)
	{
		data = JSON.parse(body);
		deps = data.dependencies;
		callback(deps);
	});
}
		

function npmdeps(pack,ver,tree) {
	getdeps(pack,ver,function(deps) {
		for (dep in deps) {
			pack2 = dep;
			ver2 = deps[dep];
			tree[pack2] = {} ;
			tree[pack2].ver = ver2;
			tree[pack2].deps = {};
			console.log(tree);
			npmdeps(pack2,ver2,tree[pack2].deps);
		}
	})

}


var tree={};
console.log(1);
npmdeps('chai','latest',tree);
console.log(2);
