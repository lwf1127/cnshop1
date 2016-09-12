<?php
class EditorWidget extends Widget{
	/*
	 * 外部组件的使用方法
	 * 1.在项目目录Lib/Widget/定义一个外部组件的类文件
	 * 2.文件名：组件的名称Widget.class.php
	 * 3.类名为：组件名称Widget
	 * 4.所有的组件类必须继承Widget的基类
	 * 5.该类中必须有一个render方法
	 * 6.该方法需要一个data的参数
	 * 该方法中必须return需要显示的内容
	 */
	public function render($data){
		$html='<!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain">'.$data[0].'</script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="'.__ROOT__.'/Public/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="'.__ROOT__.'/Public/ueditor/ueditor.all.min.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor("container");
    </script>';
	return $html;
	}	
}
?>