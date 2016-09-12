<?php
class GoodsAction extends Action{
	//添加商品
	public function add_goods(){
		//获取类别
		$class = M("Class");
		$classes = $class->order("cid desc")->select();
		$brand = M("Brand");
		$brands = $brand->order("bid desc")->select();
		$this->assign("classes",$classes);
		$this->assign("brands",$brands);
		//获取品牌
		
		$this->display();
	}
	
	//保存商品
	//保存图片
	Public function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/Goodimg/';// 设置附件上传目录
		
		//缩略图配置
		$upload->thumb = true;
		$upload->thumbMaxWidth = '50';
		$upload->thumbMaxHeight = '50';
		$upload->thumbPrefix = 'thumb_';
		$upload->thumbRemoveOrigin = false;
		if($upload->upload()) {
			$info =  $upload->getUploadFileInfo();
			return $info;
		}
	}
	//保存商品信息
	public function save_goods(){
		if(IS_POST){
			if(!empty($_FILES)){
				//上传图片并接收文件上传信息
				$result = $this->upload();
				//获取图片路径
				foreach($result as $k=>$v){
					//源图片存放路径
					$savepath = $v['savepath'].$v['savename'].",";
					//源图片缩略图存放路径
					$savethumbpath = $v['savepath']."thumb_".$v['savename'].",";
					//拼接路径字符串
					$newpath .= $savepath;
					$thumbpath .= $savethumbpath;
				}
				if($result){
					$goods = M("Goods");
					$goods->create();
					//手动对应
					$goods->detail_path = $newpath;
					$goods->thumb_path = $thumbpath;
					//保存到数据库
					$result = $goods->add();
					if($result){
						$this->success("商品添加成功",U("Goods/manage_goods"));
					}else{
						$this->error("商品添加失败",U("Goods/add_goods"));
					}
				}else{
					$this->error("上架失败",U("Goods/add_goods"));
				}
			}else{
				$this->error("至少上传一张图片",U("Goods/add_goods"));
			}
		}else{
			$this->error("上架失败",U("Goods/add_goods"));
		}
	}
	
	//管理商品
	public function manage_goods(){
		//读取文章的基本信息
		$goods = M("Goods");
		//分页
		import("ORG.Util.Page");
		$count = $goods->count();
		$page = new Page($count,10);
		$show = $page->show();
		
		//商品详情
		$goodss = $goods->field("g.*,b.bname,c.cname")->alias("g")->join("left join cnshop_brand as b on g.bid=b.bid")->join("left join cnshop_class as c on g.cid=c.cid")->order("g.gid desc")->limit($page->firstRow.",".$page->listRows)->select();
		
		$this->assign("show",$show);
		$this->assign("goodss",$goodss);
		$this->display();
	}
	
	//删除商品
	public function delete_goods(){
		if(!empty($_GET['id'])){
			$goods = M("Goods");
			//获取图片路径
			$goodss = $goods->field("detail_path,thumb_path")->find($_GET['id']);
			//删除图片
			foreach($goodss as $k=>$v){
				$v = rtrim($v,",");
				$imgpath = explode(",",$v);
				foreach($imgpath as $kk=>$vv){
					$result = unlink($vv);
				}
			}
			//删除商品信息
			$result = $goods->delete($_GET['id']);
			if($result!==false){
				$this->success("删除成功");
			}else{
				$this->error("删除成功");
			}
		}
	}
	
	//修改商品基础信息
	public function edit_goods(){
		//获取类别
		$class = M("Class");
		$classes = $class->order("cid desc")->select();
		$brand = M("Brand");
		$brands = $brand->order("bid desc")->select();
		$this->assign("classes",$classes);
		$this->assign("brands",$brands);
		//修改
		if(!empty($_GET['id'])){
			$goods = M("Goods");
			$goods = $goods->find($_GET['id']);
			$this->assign("goods",$goods);
		}
		$this->display();
	}
	
	//保存修改后的数据
	public function save_goodsedit(){
		if(IS_POST){
			$goods = M("Goods");
			$goods->create();
			$result = $goods->where("gid={$_POST['gid']}")->save();
			if($result){
				$this->success("修改成功",U("Goods/manage_goods"));
			}else{
				$this->success("修改失败",U("Goods/manage_goods"));
			}
		}
	}
	
	//修改商品图片
	public function edit_goods2(){
		$goods = M("Goods");
		if(!empty($_GET['id'])){
			$result = $goods->field('detail_path,thumb_path,description')->where("gid={$_GET['id']}")->find();
			$thumbpath = $result['thumb_path'];
			$thumbpath = rtrim($thumbpath,",");
			$thumbpath = explode(",",$thumbpath);
			//exit;
			if(!empty($thumbpath[0])){				
				$this->assign("thumbpath",$thumbpath);
			}
			$this->assign("description",$result['description']);
			
		}
		$this->display();
	}
	
	//删除修改页面的图片
	public function edit_delimg(){
		$goods = M("Goods");
		//删除图片文件
		$path = base64_decode($_GET['path']);
		$path2 = explode("thumb_",$path);
		$path2 = $path2[0].$path2[1];
		$rusult = unlink($path);
		$rusult = unlink($path2);
		$result = $goods->field('detail_path,thumb_path')->where("gid={$_GET['id']}")->find();
		$imgpath = explode($path2.",",$result['detail_path']);
		$thumbpath = explode($path.",",$result['thumb_path']);
		$imgpath = $imgpath[0].$imgpath[1];
		$thumbpath = $thumbpath[0].$thumbpath[1];
		$goods->detail_path = $imgpath;
		$goods->thumb_path = $thumbpath;
		$result = $goods->where("gid={$_GET['id']}")->save();
		if($result){
			$this->success("删除成功");
		}else{
			$this->error("删除失败");
		}
	}
	//保存修改后的数据
	public function edit_imgsave(){
		$goods = M("Goods");
		$goods->create();
		if(IS_POST){
			if(empty($_FILES)){
				//手动对应
				$goods->description = $description;
			}else{
				//上传图片并接收文件上传信息
				$result = $this->upload();
				//获取图片路径
				foreach($result as $k=>$v){
				//源图片存放路径
					$savepath = $v['savepath'].$v['savename'].",";
					//源图片缩略图存放路径
					$savethumbpath = $v['savepath']."thumb_".$v['savename'].",";
					//拼接路径字符串
					$newpath .= $savepath;
					$thumbpath .= $savethumbpath;
				}
				if($result){
					$goods = M("Goods");
					$goods->create();
					//手动对应
					$goods->detail_path = $newpath;
					$goods->thumb_path = $thumbpath;
					$goods->description = $description;
				}
			}
				//保存到数据库
			$result = $goods->where("gid={$_GET['id']}")->save();
			if($result){
				$this->success("商品修改成功",U("Goods/manage_goods"));
			}else{
				$this->error("商品修改失败");
			}
		}else{
			$this->error("修改失败");
		}
	}
}


















?>