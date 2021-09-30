
class User extends Controller
{
    public function scopeRegister($query,$request)
    {
        $data = $request->all();
        $user = User::create($data);
    }
}

?>