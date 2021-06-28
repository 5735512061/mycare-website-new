<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $key = Artisan::call('key:generate');
    return 'DONE';
});

// Route::get('/key-gen', function() {
//     $key = Artisan::call('key:generate');
//     return 'DONE';
// });


Route::group(['prefix' => '/'], function(){
	
    Route::get('/','Frontend\\HomesController@index')->name('member.home');
    Route::get('/member/register','Frontend\\MembersController@register');
    Route::post('/member/register','Frontend\\MembersController@registerPost');
    Route::get('/promotion','Frontend\\AboutsController@promotion');

});

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'admin'], function(){
        Route::get('/member','Backend\\AdminsController@member')->name('home'); //แสดงข้อมูลสมาชิกทั้งหมด
        Route::get('/information-member/{id}','Backend\\AdminsController@information_member'); //แสดงข้อมูลสมาชิกแต่ละคน
        Route::get('/member/create-member/{id}','Backend\\AdminsController@create_member'); //หน้าเพิ่มป้ายทะเบียนรถ
        Route::post('/member/create-member','Backend\\AdminsController@create_memberPost'); //เพิ่มป้ายทะเบียนรถ
        Route::get('/member-edit/{id}','Backend\\AdminsController@member_editList'); //หน้าแก้ไขข้อมูลสมาชิก
        Route::post('/member-update','Backend\\AdminsController@member_updateList'); //อัพเดตข้อมูลสมาชิก
        Route::get('/member-delete/{id}','Backend\\AdminsController@member_delete'); //ลบข้อมูลสมาชิก
        Route::post('/member/search-member','Backend\\AdminsController@search_member');
        Route::get('/member/status-member/{id}','Backend\\AdminsController@statusMemberForm'); //เพิ่ม
        Route::get('/member/status-member/{id}/{status}','Backend\\AdminsController@statusMember'); //เพิ่ม
        //website
        Route::get('/member-register','Backend\\AdminsController@member_register'); //สมัครสมาชิกผ่านเว็บไซต์
        Route::get('/member-registerWarning','Backend\\AdminsController@member_registerWarning'); //ยังไม่เปิดบัตรสมาชิก
        Route::get('/member-information/{id}','Backend\\AdminsController@member_information'); //ข้อมูลสมาชิกสำหรับเปิดบัตร
        Route::get('/member/member-edit/{id}','Backend\\AdminsController@member_edit'); //หน้ายืนยันข้อมูลการเปิดบัตรสมาชิก
        Route::post('/member/member-update','Backend\\AdminsController@member_update'); //เปิดบัตรสมาชิก
        Route::post('/member/member-delete/{id}','Backend\\AdminsController@delete_member'); //ลบข้อมูลการสมัครสมาชิก
        //พันธมิตร
        Route::get('alliance/register-alliance','Backend\\AdminsController@register_alliance'); //หน้าลงทะเบียนพันธมิตร
        Route::post('alliance/register-alliance','Backend\\AdminsController@register_alliancePost'); //บันทึกข้อมูลพันธมิตร
        Route::get('alliance','Backend\\AdminsController@alliance'); //แสดงข้อมูลพันธมิตร
        Route::get('/alliance-edit/{id}','Backend\\AdminsController@alliance_edit');
        Route::post('/alliance-update','Backend\\AdminsController@alliance_update'); 
        Route::get('/alliance-delete/{id}','Backend\\AdminsController@alliance_delete'); 
        //พนักงาน
        Route::get('staff/register-staff','Backend\\AdminsController@register_staff'); //หน้าลงทะเบียนพนักงาน
        Route::post('staff/register-staff','Backend\\AdminsController@register_staffSubmit')->name('register.staff.submit'); //บันทึกข้อมูลพนักงาน
        Route::get('staff','Backend\\AdminsController@staff'); //แสดงข้อมูลพนักงาน
        Route::get('/staff-delete/{id}','Backend\\AdminsController@staff_delete'); //ลบข้อมูลพนักงาน
        //ของรางวัล
        Route::get('reward','Backend\\AdminsController@reward'); //แสดงของรางวัล
        Route::get('create-reward','Backend\\AdminsController@create_reward'); //หน้าเพิ่มของรางวัล
        Route::post('create-reward','Backend\\AdminsController@create_rewardPost'); // เพิ่มของรางวัล
        Route::get('statistic','Backend\\AdminsController@statistic');
        Route::get('/statistic-delete/{id}','Backend\\AdminsController@statistic_delete');
        Route::get('/summary-statistic','Backend\\AdminsController@summary_statistic');
        Route::get('/summary-statistic/{id}','Backend\\AdminsController@summary_statisticID');
		Route::get('/statistic/{store_name}/{year}/{month}','Backend\\AdminsController@SummarystatisticMonth');
        Route::get('reward/exchange','Backend\\AdminsController@exchange');
        Route::get('/reward/exchange/update/{id}','Backend\\AdminsController@reward_exchange_update');
        Route::get('/exchange-delete/{id}','Backend\\AdminsController@exchange_delete');
        Route::get('/reward-edit/{id}','Backend\\AdminsController@reward_edit');
        Route::post('/reward-update','Backend\\AdminsController@reward_update'); 
        Route::get('/reward-delete/{id}','Backend\\AdminsController@reward_delete');
        //บริการ
        Route::get('/service/{id}','Backend\\AdminsController@service');
        Route::get('/create-service/{id}','Backend\\AdminsController@create_service');
		Route::post('/create-service','Backend\\AdminsController@create_servicePost');
        Route::get('/service-information/{id}','Backend\\AdminsController@service_information');
        Route::get('/service-edit/{id}','Backend\\AdminsController@service_edit');
        Route::post('/service-update','Backend\\AdminsController@service_update'); 
        Route::get('/service-delete/{id}','Backend\\AdminsController@service_delete'); 
        // เซลล์
        Route::get('/sales-register','Backend\\AdminsController@salesRegister');
        Route::post('/sales-register','Backend\\AdminsController@salesRegisterPost');
        Route::get('/sales','Backend\\AdminsController@sales');

        Route::get('/information-sales/{id}','Backend\\AdminsController@informationSales');
        Route::get('/create-sales/{id}','Backend\\AdminsController@createSales'); //หน้าเพิ่มป้ายทะเบียนรถ
        Route::post('/create-sales','Backend\\AdminsController@createSalesPost'); //เพิ่มป้ายทะเบียนรถ
        Route::get('/sales-edit/{id}','Backend\\AdminsController@salesEdit'); //หน้าแก้ไขข้อมูลสมาชิก
        Route::post('/sales-update','Backend\\AdminsController@salesUpdate'); //อัพเดตข้อมูลสมาชิก
        Route::get('/sales-delete/{id}','Backend\\AdminsController@salesDelete'); //ลบข้อมูลสมาชิก
        Route::post('/sales/search-member','Backend\\AdminsController@salesSearch');

        Route::get('/sales-registerWarning','Backend\\AdminsController@salesRegisterWarning'); //ยังไม่เปิดบัตรสมาชิก
        Route::get('/sales-information/{id}','Backend\\AdminsController@salesInformation'); //ข้อมูลสมาชิกสำหรับเปิดบัตร
        Route::get('/sales/sales-edit/{id}','Backend\\AdminsController@confirmCard'); //หน้ายืนยันข้อมูลการเปิดบัตรสมาชิก
        Route::post('/sales/sales-update','Backend\\AdminsController@updateCard'); //เปิดบัตรสมาชิก
        Route::post('/sales/sales-delete/{id}','Backend\\AdminsController@deleteRegister'); //ลบข้อมูลการสมัครสมาชิก


        Route::get('/service-sales/{id}','Backend\\AdminsController@serviceSales');
        Route::get('/createService-sales/{id}','Backend\\AdminsController@createServiceSales');
        Route::post('/createService-sales','Backend\\AdminsController@createServiceSalesPost');
        Route::get('/serviceInformation-sales/{id}','Backend\\AdminsController@serviceInformationSales');
        Route::get('/serviceEdit-sales/{id}','Backend\\AdminsController@serviceEditSales');
        Route::post('/serviceUpdate-sales','Backend\\AdminsController@serviceUpdateSales'); 
        Route::get('/serviceDelete-sales/{id}','Backend\\AdminsController@serviceDeleteSales'); 

        // โปรแกรมรันเลขบัตรมายแคร์เซลล์ 16 หลัก
        Route::get('/random','Backend\\AdminsController@random');
        Route::get('/randomPost','Backend\\AdminsController@randomPost');

	});
});

Route::group(['prefix' => 'staff'], function(){
    Route::get('/login','AuthStaff\LoginController@ShowLoginForm')->name('staff.login');
    Route::post('/login','AuthStaff\LoginController@login')->name('staff.login.submit');
    Route::post('/logout', 'AuthStaff\LoginController@logout')->name('staff.logout');
    Route::get('/member','Backend\\StaffsController@member')->name('staff.home'); //แสดงข้อมูลสมาชิกทั้งหมด

    Route::get('/information-member/{id}','Backend\\StaffsController@information_member'); //แสดงข้อมูลสมาชิกแต่ละคน
    Route::get('/member/create-member/{id}','Backend\\StaffsController@create_member'); //หน้าเพิ่มป้ายทะเบียนรถ
    Route::post('/member/create-member','Backend\\StaffsController@create_memberPost'); //เพิ่มป้ายทะเบียนรถ
    Route::post('/member/search-member','Backend\\StaffsController@search_member');
    
    //บริการ
    Route::get('/service/{id}','Backend\\StaffsController@service');
    Route::get('/create-service/{id}','Backend\\StaffsController@create_service');
	Route::post('/create-service','Backend\\StaffsController@create_servicePost');
    Route::get('/service-information/{id}','Backend\\StaffsController@service_information');

    // เซลล์
    Route::get('/sales','Backend\\StaffsController@sales');
    Route::get('/sales-register','Backend\\StaffsController@salesRegister');
    Route::post('/sales-register','Backend\\StaffsController@salesRegisterPost');
    Route::get('/information-sales/{id}','Backend\\StaffsController@informationSales');
    Route::get('/create-sales/{id}','Backend\\StaffsController@createSales'); //หน้าเพิ่มป้ายทะเบียนรถ
    Route::post('/create-sales','Backend\\StaffsController@createSalesPost'); //เพิ่มป้ายทะเบียนรถ
    Route::post('/sales/search-member','Backend\\StaffsController@salesSearch');

    Route::get('/service-sales/{id}','Backend\\StaffsController@serviceSales');
    Route::get('/createService-sales/{id}','Backend\\StaffsController@createServiceSales');
    Route::post('/createService-sales','Backend\\StaffsController@createServiceSalesPost');
    Route::get('/serviceInformation-sales/{id}','Backend\\StaffsController@serviceInformationSales');

});

Route::group(['prefix' => 'member'], function(){
	Route::get('/login','AuthMember\LoginController@ShowLoginForm')->name('member.login');
    Route::post('/login','AuthMember\LoginController@login')->name('member.login.submit');
    Route::post('/loginRegisCard','AuthMember\LoginController@loginRegisCard')->name('member.loginRegisCard.submit');
    Route::post('/logout', 'AuthMember\LoginController@logout')->name('member.logout');
    Route::post('/sales/logout', 'AuthMember\LoginController@salesLogout')->name('sales.logout');
    Route::get('/change-password', 'AuthMember\ChangePasswordController@index')->name('password.change');
    Route::post('/change-password', 'AuthMember\ChangePasswordController@changePassword')->name('password.update');
    Route::get('/ForgetPassword', 'AuthMember\ForgetPasswordController@index')->name('password.forget');
    Route::post('/ForgetPasswordForm', 'AuthMember\ForgetPasswordController@forgetForm')->name('password.forget.form');
    Route::post('/Password-Confirm', 'AuthMember\ForgetPasswordController@confirm')->name('password.confirm');
    Route::post('/ForgetPassword', 'AuthMember\ForgetPasswordController@UpdatePassword')->name('password.updateForget');

    Route::get('/register-card','Frontend\\MembersController@registerCard');
    Route::post('/register-card','Frontend\\MembersController@registerCardPost')->name('register-card.submit');
    Route::get('/register-cardForm','Frontend\\MembersController@registerCardForm');
    
    Route::get('/profile','Frontend\\MembersController@profile');
    Route::get('/profile-change','Frontend\\MembersController@profileChange');
    Route::post('/profile-update','Frontend\\MembersController@profileUpdate');
    Route::get('/tel-change','Frontend\\MembersController@telChange');
    Route::post('/tel-update','Frontend\\MembersController@telUpdate');
    Route::get('/reward-history/{id}','Frontend\\MembersController@rewardHistory');

    Route::get('/reward-redem/{id}','Frontend\\RewardsController@reward_redem');
    Route::post('/reward-success','Frontend\\RewardsController@reward_success');

    // Service
    Route::get('/service/car-list/{id}','Frontend\\ServicesController@serviceCarList');
    Route::get('/service-history/{id}','Frontend\\ServicesController@serviceHistory');
    Route::get('/service-information/{id}','Frontend\\ServicesController@serviceInformation');

    // Service_Sales
    Route::get('/sales/service/car-list/{id}','Frontend\\ServiceSalesController@serviceCarList');
    Route::get('/sales/service-history/{id}','Frontend\\ServiceSalesController@serviceHistory');
    Route::get('/sales/service-information/{id}','Frontend\\ServiceSalesController@serviceInformation');

    // Reward
    Route::get('/sales/reward-history/{id}','Frontend\\ServiceSalesController@rewardHistory');

});



Route::group(['prefix' => '/about'], function(){
	
    Route::get('/sitemap','Frontend\\AboutsController@sitemap');
    Route::get('/contact','Frontend\\AboutsController@contact');
    Route::post('/contact','Frontend\\AboutsController@contactPost');
    Route::get('/','Frontend\\AboutsController@about_us');
    Route::get('/condition','Frontend\\AboutsController@condition');
    Route::get('/faqs','Frontend\\AboutsController@faqs');
    Route::get('/howto-regis','Frontend\\AboutsController@howto_regis');

});

Route::group(['prefix' => '/alliance'], function(){
	
    Route::get('/index','Frontend\\AlliancesController@index');
    Route::get('/store','Frontend\\AlliancesController@store');
    Route::get('/lifestyle','Frontend\\AlliancesController@lifestyle');
    Route::get('/car-service','Frontend\\AlliancesController@carservice');
    Route::get('/hotel','Frontend\\AlliancesController@hotel');
    Route::get('/detail/{id}','Frontend\\AlliancesController@detail');

    // ระบบร้านพันธมิตร
	Route::get('/login','AuthStore\LoginController@ShowLoginForm')->name('store.login');
    Route::post('/login','AuthStore\LoginController@login')->name('store.login.submit');
    Route::post('/logout', 'AuthStore\LoginController@logout')->name('store.logout');
    
    Route::get('/','Backend\\AlliancesController@alliance')->name('store.home');

});

Route::group(['prefix' => '/privilege'], function(){
	
    Route::get('/point','Frontend\\PrivilegesController@point');
    Route::get('/reward-points','Frontend\\PrivilegesController@reward_points')->middleware('guest:memberandsale');                                                                 
    Route::get('/reward-detail/{id}','Frontend\\PrivilegesController@reward_detail'); 

    Route::get('/reward-food','Frontend\\PrivilegesController@rewardFood');      
    Route::get('/reward-gadget','Frontend\\PrivilegesController@rewardGadget');      
    Route::get('/reward-other','Frontend\\PrivilegesController@rewardOther');      
    
    // Route::get('/{store_name}/index','Frontend\\StoresController@index');
    // Route::get('/{store_name}','Frontend\\StoresController@alliance_privilege');

    Route::get('/{store_name}','Frontend\\StoresController@index');
    Route::post('/store/receive','Frontend\\StoresController@privilege_receive');           
    
    Route::get('/expire-mycare-member/{store_name}','Frontend\\ExpireStoresController@expire');
    Route::post('/expire/store/receive','Frontend\\ExpireStoresController@privilege_receive');

});


