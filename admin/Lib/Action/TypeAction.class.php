<?php
class TypeAction extends Action{
	//添加类别的方法
	public function add_type(){
		$this->assign("action","添加");
		$this->display();	
	}
	//保存文章类别
	public function  save_type(){
		if(IS_POST){
			//创建类型表的模型
			$type = M("Class");
			//将表单中的表单项和字段对应
			$type->create();
			//将数据保存到数据库
			if(empty($_POST['id'])){
				//添加
				$result = $type->add();
				$msg = "添加";
			}else{
				//修改
				$result = $type->where("cid={$_POST['id']}")->save();
				$msg = "修改";
			}
			if($result){
				$this->success("类别{$msg}成功",U('Type/manage_type'));
			}else{
				$this->error("类别{$msg}失败");
			}
		}
	}
	//类别管理的方法
	public function manage_type(){
		//查询所有的类别
		$type = M("Class");
		$types = $type->order("cid desc")->select();
		
		$this->assign("types",$types);
		$this->display();
	}
	//删除类别的方法
	public function delete_type(){
		if(!empty($_GET['id'])){
			//删除某一个ID的类别
			$type = D("Class");
			$result = $type->delete($_GET['id']);
			if($result!==false){
				$this->success("删除成功!");
			}else{
				$this->error("删除失败!");
			}
		}
	}
	//修改类别的方法
	public function edit_type(){
		if(!empty($_GET['id'])){
			$type = M("Class");                  
			$type = $type->find($_GET['id']);  //查询单条数据
			
			$this->assign("type",$type);
			$this->assign("action","修改");
			$this->display('add_type');
		}
	}
}
?>