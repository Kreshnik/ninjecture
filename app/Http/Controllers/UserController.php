<?php

namespace App\Http\Controllers;

use App\Modules\User\Service\Contract\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Return list of wherever...
     */
    public function index()
    {
        $ninja = "　　　　　　　　　,　‐ ､　　　　　/／_ - ￣
　　 　 　 　 　 l /　　ﾞl',　　　/ ／ 　＿　―　￣
　　　　　 　 　 l lｪｫｔｧl,'_,／/　 _ ‐
　　　　　　　／l,l忍殺ゝ〉ヽﾌ'´_ ｪ ﾆ ﾆ─　―
　　　　　, ィ ､ヽ`二／/／ ／ ヽ
　　　 /　_ ィヽ＼ /／‐／,ヾ＼　l
　　　/_// l　 ヽーァ'' ／　;　',`ｰl
　　 /　/　,l　 , 'ゝ'　／　　,l,　l　 ヽ
　　/l / 　 ｌl ' ／／,　　　 /ヽ ヽ　 l;
　／‐ 〉／ 〈､∠ ＿＿　 ｲ　 `､ l_,/_l
　l―‐Ｋ　　/ｰ;‐ーニー''´lヽ　l　　'､'､
　l i i　l　　/,ヽl ＼ l l／　 l　ヽ'､ー l　l
　ｌ i i　l　,/ ヽ/l　ゝi,,l　 　 l　 li　l　 l　l
　/―へ/ l　 / /／; ,ヽ､　､　l l　l‐ｉ‐ l
　l´l\"lヽｸ, ヽ//　　､　　ヽ　ヽl/ //'l‐'l
　ヽ- ツ　l　　l　　　;　　,/　　l　ヾ'ﾆｰ'
　　　　　 l　　 l　　 ;　　 l　　 l
　　　　　l　　 ,'　　 ;　　 l　　 l
　　　　　l　 く　　　;　　 ,'　　 l
　　　　　 ヽ'l' ヽ, ､;　　 ヽ.　 /
　　　　　　ヽー;　'lヽ ィ⌒;､/
　　　　　　　'ｌ　l　l　/ヽ-',-l
　　　　　　　 l　l　l､ l l 　 l　l
　　　　　　　〈ー‐' 〉.l l　 l /
　　　　　　　`l二l,/　l l　,'/
　　　　　　　 l.ヒ'l l　,l_l_ l,'
　　　　　　　ヽ`''　l / ＿ ヽ
　　　　　　　　￣ ' l / -ヽ;";

        return $ninja;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->userService->insertGetUser($request);
    }
}
