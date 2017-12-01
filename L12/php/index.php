<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx4bc51c2f896f65eb", "0430130fab18ed36fe46f5dbf9688292");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <style type="text/css">
  	button{
  		font-size: 40px;
  		width:90%;
  		margin: 20px auto;
  		display: block;
  	}
  </style>
</head>
<body>
  <!--<img id="image" src="img/timg.jpg" />-->
  <button id="chooseImage">选择图片</button>
  <button id="previewImage">previewImage</button>
  <button id="startRecord">开始录音</button>
  <button id="stopRecord">停止录音</button>
  <button id="playVoice">播放录音</button>
  <button id="translateVoice">转换成文字</button>
  <button id="openLocation">打开地图</button>
  <button id="scanQRCode">scanQRCode</button>
  
  
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
//	var json = {'name':"王小明",'age':"12"}
	  
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ['scanQRCode','getLocation','openLocation','chooseImage','onMenuShareTimeline','onMenuShareAppMessage','startRecord','stopRecord','playVoice','translateVoice']
  });
  wx.ready(function () {
    // 在这里调用 API
	    wx.checkJsApi({
		    jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
		    success: function(res) {
		    		console.log(res);
		        // 以键值对的形式返回，可用的api值true，不可用为false
		        // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
		    }
			});
			
			wx.onMenuShareTimeline({
			    title: '全国高校校花微信号列表，速来.....', // 分享标题
			    link: 'http://demo.niyinlong.com/demo1/demo.html', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			    imgUrl: 'http://demo.niyinlong.com/demo1/img/excel.jpg', // 分享图标
			    success: function () { 
			       // 用户确认分享后执行的回调函数
						console.log("OK");
			    },
			    cancel: function () { 
			        // 用户取消分享后执行的回调函数
						console.log("error");
			    }
			});
			
			wx.onMenuShareAppMessage({
			    title: '全国高校校花微信号列表，速来.....', // 分享标题
			    desc: '全国高校校花微信号列表，速来.....', // 分享描述
			    link: 'http://demo.niyinlong.com/demo1/demo.html', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			    imgUrl: 'http://demo.niyinlong.com/demo1/img/excel.jpg', // 分享图标
			    type: 'link', // 分享类型,music、video或link，不填默认为link
			    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			    success: function () { 
			        // 用户确认分享后执行的回调函数
			    },
			    cancel: function () { 
			        // 用户取消分享后执行的回调函数
			    }
			});
			
			document.querySelector("#chooseImage").onclick = function(){
						wx.chooseImage({
					    count: 1, // 默认9
					    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
					    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
					    success: function (res) {
					        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
					       var img = document.createElement("img");
					       img.setAttribute("src",localIds);
					   			document.querySelector("body").appendChild(img);
					    }
					});
			};
			
			document.querySelector("#previewImage").onclick = function(){
				
					wx.previewImage({
				    current: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512109786346&di=2ae83edc384f2455e0fc2ab196144b00&imgtype=0&src=http%3A%2F%2Fpic38.nipic.com%2F20140306%2F251960_125327345000_2.jpg', //当前显示图片的http链接
				    urls: ['https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512109786346&di=2ae83edc384f2455e0fc2ab196144b00&imgtype=0&src=http%3A%2F%2Fpic38.nipic.com%2F20140306%2F251960_125327345000_2.jpg','https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512109786344&di=54295aec8814829b3cb66a140bfc4907&imgtype=0&src=http%3A%2F%2Fpic.pp3.cn%2Fuploads%2F201704%2F2017050602.jpg','https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512109786340&di=92a301786a24a941577b0416a9aeb0ed&imgtype=0&src=http%3A%2F%2Fwww.51modo.cc%2Fupload%2Fkindeditor%2Fimage%2F20160707%2F20160707004025_88365.jpg'] //需要预览的图片http链接列表
					});
					
			};
			
			
			document.querySelector("#startRecord").onclick = function(){
					wx.startRecord();
			}	
			var localId = 0;
			document.querySelector("#stopRecord").onclick = function(){
					wx.stopRecord({
			   		 success: function (res) {
					        localId = res.localId;
					   }
					});
			}
			
			document.querySelector("#playVoice").onclick = function(){
					wx.playVoice({
					    localId: localId// 需要播放的音频的本地ID，由stopRecord接口获得
					});
			}
			
			document.querySelector("#translateVoice").onclick = function(){
				wx.translateVoice({
					   localId: localId, // 需要识别的音频的本地Id，由录音相关接口获得
					   isShowProgressTips: 1, // 默认为1，显示进度提示
					   success: function (res) {
					        alert(res.translateResult); // 语音识别的结果
					    }
					});
			}
			var latitude = 0; // 纬度，浮点数，范围为90 ~ -90
			var longitude = 0; // 经度，浮点数，范围为180 ~ -180。
			var speed = 0; // 速度，以米/每秒计
			var accuracy = 0; // 位置精度
			wx.getLocation({
			    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
			    success: function (res) {
			        latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
			        longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
			        speed = res.speed; // 速度，以米/每秒计
			        accuracy = res.accuracy; // 位置精度
			    }
			
			});
			
			document.querySelector("#openLocation").onclick = function(){
						wx.openLocation({
						    latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
						    longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
						    name: '我正站在的地方', // 位置名
						    address: '测试利用微信网页打开地图', // 地址详情说明
						    scale: 14, // 地图缩放级别,整形值,范围从1~28。默认为最大
						    infoUrl: 'http://www.niyinlong.com' // 在查看位置界面底部显示的超链接,可点击跳转
						});
			}
			
			
				document.querySelector("#scanQRCode").onclick = function(){
						wx.scanQRCode({
					    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
					    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
					    success: function (res) {
					    	var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
					    	
					    	console.log(result);
							}
						});
				}
			
			
  });
</script>
</html>
