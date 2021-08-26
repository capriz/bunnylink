(self.webpackChunk=self.webpackChunk||[]).push([[354],{3354:(t,a,e)=>{"use strict";e.r(a),e.d(a,{default:()=>N});var r=e(5166),d=(0,r.withScopeId)("data-v-78b5f3b8");(0,r.pushScopeId)("data-v-78b5f3b8");var l={class:"container-fluid p-0"},s=(0,r.createVNode)("h1",{class:"h3 mb-3"},"Rabbits",-1),i={class:"row"},o={class:"col-12"},c={class:"card"},n=(0,r.createVNode)("div",{class:"card-header"}," Rabbits Data Table ",-1),b={class:"card-body"},u={class:"row"},f={class:"col-12 mt-3"},p=(0,r.createVNode)("i",{class:"fas fa-plus"},null,-1),v=(0,r.createTextVNode)(" Add a Rabbit"),m=(0,r.createVNode)("div",{class:"col-12 mt-3"},[(0,r.createVNode)("table",{id:"rabbits-table",class:"table table-hover nowrap",style:{width:"100%"}})],-1);(0,r.popScopeId)();var h=d((function(t,a,e,d,h,_){return(0,r.openBlock)(),(0,r.createBlock)("div",null,[(0,r.createVNode)("div",l,[s,(0,r.createVNode)("div",i,[(0,r.createVNode)("div",o,[(0,r.createVNode)("div",c,[n,(0,r.createVNode)("div",b,[(0,r.createVNode)("div",u,[(0,r.createVNode)("div",f,[(0,r.createVNode)("a",{href:e.data.rabbits_form_link,class:"btn btn-primary"},[p,v],8,["href"])]),m])])])])])])])}));const _={name:"Rabbits.vue",props:["data"],data:function(){return{dt:null}},mounted:function(){var t=this;t.dt=$("#rabbits-table").DataTable({scrollX:!0,serverSide:!0,ajax:{url:t.data.rabbits_table_link,type:"POST"},order:[[0,"desc"]],columns:[{data:function(t){var a="";return a+="<a href='"+t.rabbits_update_link+"' class='btn btn-link'>"+t.tag_id+"</a>",t.avatar&&(a+="<button class='btn btn-sm btn-info btn-img text-white'><i class='fas fa-image'></i></button>"),a},name:"tag_id",title:"ID"},{data:"cage_no",title:"Cage No."},{data:"category",title:"Category"},{data:"breed",title:"Breed"},{data:"type",title:"Type"},{data:"color",title:"Color"},{data:"dob",title:"Date Of Birth"},{data:"gender",title:"Gender"},{data:function(t){return t.rabbit_status.color||(t.rabbit_status.color="black"),"<label class='fw-bolder' style='color: "+t.rabbit_status.color+"'>"+t.status+"</label>"},name:"status",title:"Status"},{data:function(t){return parseInt(t.home_breed)?"Yes":"No"},name:"home_breed",title:"Home Breed?"},{data:"litter_no",title:"Litter ID"},{data:"created_at",title:"Created At"},{data:"notes",title:"Notes"},{data:"inserted_by",title:"Inserted By"},{data:"updated_by",title:"Updated By"}],drawCallback:function(a){$(".btn-img").on("click",(function(){var a=t.dt.row($(this).parent()).data();alertify.alert("<img src='/"+a.avatar+"' class='img-fluid' width='800px'>",(function(){alertify.message("OK")}))}))}})}};_.render=h,_.__scopeId="data-v-78b5f3b8";const N=_}}]);
//# sourceMappingURL=354.js.map?id=6e703741b428ab8157da