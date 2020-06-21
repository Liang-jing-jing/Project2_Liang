# SOFT130002_Project2

#### 梁菁菁 19302010061

## 基本功能完成情况

### 首页

#### 1.个人中心登录与登出

我运用Session来存储用户的登录情况，并且然后通过调用$_SESSION['user']来判断用户是否登录：
如果！isset['user']，导航栏的个人中心只显示Log in来提示用户登录；
如果isset['user']，那么导航栏的个人中心会像PJ1中一样展示下拉菜单，并且登录按钮改为登出按钮

同时用户点击登出时，自动跳转到Log in界面，在log in页面中我unset($_SESSION['user'])来清除用户登录记录

#### 2.从后端数据库读取收藏最多的图片

我在处理收藏逻辑时，在数据库中增加了表favoredImage，表中有两列分别记录图片路径PATH和用户名称user
然后我用sql3="SELECT PATH AS PATH, COUNT(*) AS COUNTS FROM favoredImage GROUP BY PATH ORDER BY COUNT(*) DESC"
找到PATH列中出现次数最多的数据并一一获取，然后根据PATH在travelimage表中找到其他相关数据，然后一一打印图片及标题等数据

#### 3.刷新图片
利用Rand()函数，得到随机数，然后从travelimage表中获得其他数据，然后打印6张图片

### 浏览页

#### 1.标题搜索模糊查询
模糊查询使用LIKE

向browser.php进行post，然后$_POST获取输入的内容，再设为SESSION，
在浏览页面再通过SESSION调用查询，再打印出符合条件的图片

#### 2.国家城市主题联合查询

用POST获取国家城市主题数据，然后设置为SESSION，浏览页通过SESSION调用

然后sql语句中用WHERE...AND...进行联合查询，并打印出符合条件的图片

#### 3.热门国家、城市、主题查询

在左边侧边栏中有热门国家、城市、主题，每一个都有链接，链接到browser.php，然后通过$_GET获取，再设置为$_SESSION，
在浏览页面中通过SESSION调用，然后用SQL调出数据库中符合条件的图片并打印出来

#### 4.五种查询方式不冲突

在browser.php中处理时，如果使用了一种查询方式，就会将其他方式的session清除，从而前面的结果不会影响此次查询结果。

#### 5.页码

根据结果范围，计算页数，例如结果在0-12，就是一页，大于60，只记5页，
所在页面的页码会灰色高亮


### 搜索页

搜索逻辑与页码逻辑类似于浏览页

同时搜索页只能用一种查询方式，例如只能用标题查询或者只能用描述查询，同时支持模糊查询，
如果同时用两种方式查询，会提示用户只能用一种方式查询



### 上传页面

#### 1.合法性校验

信息完整才会用upload.php进行处理，并将数据上传到myphoto表中；
信息不完整就会有提示，不让用户上传；
增加了主题的下拉菜单选择器，并根据世界上人口最多的国家和城市排名，做了二级联动的下拉菜单选择器


#### 2.上传功能与修改功能判断

由于用户要修改必须从我的照片页面进入，所以我的照片页面的修改按钮链接到上传页面，并传参数id=myphoto，
从而判断这张照片是要修改的而并非上传的。也会传其他参数来给上传页面这张图片的其他信息。

用if...else...判断好照片是用于上传的还是修改的之后，如果是上传，就是按钮上传，如果是修改，就变为修改按钮。
同时如果是修改功能，上传页面在ifelse判断过后会展示该图片原先的信息。
此外，修改图像是覆盖原先图像而非新建图像。

### 我的照片、我的收藏

分别从myphoto和favoredImage表中读取当前用户的照片与收藏，然后一一打印在界面上；
我的照片页面有修改和删除按钮，修改功能在上传页面已经描述，删除功能用sql语句delete来从表中找到对应的userName和PATH进行删除；
我的收藏页面与我的照片页面做法基本相同，只是没有修改功能而已。

### 图片详情

由于用户访问到图片详情页必然是点击了某张图片，所以在代码中所有图片的链接都会向图片详情页传入参数path，
再从travelimage表中找到对应的path所对应的数据，然后在网页中展示出来。

如果是我的照片页面中的照片，则会传入图片的所有信息，并传入参数id=myphoto，好让图片详情页判断，
从而直接用传入的数据进行展示。

图片详情页显示改图片增加数量时，是通过sql循环查询favoredImage表中与该图片PATH相同的，如果出香相同的，
收藏数+1，最后得出总收藏数，并展示在页面中。

图片详情页还可以让用户收藏图片：如果用户还未登录，会提示用户登录，并且会有登录链接指引用户登录；
如果用户已经登录就可以传入favor.php，再在该页代码中上传用户名以及图片的path来进行收藏。
收藏后图片详情页显示的收藏数量会增加1。


## Bonus
本次PJ，我尝试了Bonus3，尝试部署服务器。
服务器ip：121.89.199.66
由于服务器Apache和PHP还未完全安装好，所以PJ2尚未完全部署在服务器中。
静态网址：http://localhost:63342/Project2_Liang/index.php?_ijt=k8qloohrgn480qremocbf0s42o
