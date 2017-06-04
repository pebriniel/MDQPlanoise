var Conclave=(function(){
	var buArr =[],arlen;
	return {
		init:function(){
			this.addCN();this.clickReg();
		},
		addCN:function(){
			var buarr=["slide_awayL2","slide_awayL1","slide_center","slide_awayR1","slide_awayR2"];
			for(var i=1;i<=buarr.length;++i){
				$("#img"+i).removeClass().addClass(buarr[i-1]+" slide");
			}
		},
		clickReg:function(){
			$(".slide").each(function(){
				buArr.push($(this).attr('class'))
			});
			arlen=buArr.length;
			for(var i=0;i<arlen;++i){
				buArr[i]=buArr[i].replace(" slide","")
			};
			$(".slide").click(function(buid){
				var me=this,id=this.id||buid,joId=$("#"+id),joCN=joId.attr("class").replace(" slide","");
				var cpos=buArr.indexOf(joCN),mpos=buArr.indexOf("slide_center");
				if(cpos!=mpos){
					tomove=cpos>mpos?arlen-cpos+mpos:mpos-cpos;
					while(tomove){
						var t=buArr.shift();
						buArr.push(t);
						for(var i=1;i<=arlen;++i){
							$("#img"+i).removeClass().addClass(buArr[i-1]+" slide");
						}
						--tomove;
					}
				}
			})
		},
		auto:function(){
			for(i=1;i<=1;++i){
				$(".slide").delay(4000).trigger('click',"img"+i).delay(4000);
				console.log("called");
			}
		}
	};
})();

$(document).ready(function(){
	window['conclave']=Conclave;
	Conclave.init();
})
