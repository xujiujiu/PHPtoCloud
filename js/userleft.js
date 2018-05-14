$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});
//改变管理位置标记--------------------------------------------------------------
function changeAdminFlag(Content){
   var row=parent.parent.bottom.document.all.Trans.rows[0];
   row.cells[3].innerHTML = Content ;
   return true;
}
//切换账号提示--------------------------------------------------------------------------
function AdminOut()
{
  // if (confirm("您真的要退出管理操作吗？"))
   top.location.replace('user_login.htm');
}
//管理员退出登录提示--------------------------------------------------------------------------
function checkOut()
{
   if (confirm("您真的要退出管理操作吗？"))
   top.location.replace('../login/login.htm');
}
