<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function showUserManagement()
    {
        return view('admin.user');
    }

    public function getUserData()
    {
        try{

            // $dataUser = User::where('role', 'user')->get();
            $dataUser = User::where('id', '!=', Auth::id())->get();

            $data = array();

            $no = 1;

            foreach($dataUser as $user){
                $row = array();
                $row[] = $no++;
                $row[] = $user->name ?? '-';
                $row[] = $user->email ?? '-';
                $row[] = ucfirst($user->role ?? '-');

                if ($user->is_approved === 'approved') {
                    $row[] = '<span class="badge bg-success">Approved</span>';
                } elseif ($user->is_approved === 'rejected') {
                    $row[] = '<span class="badge bg-danger">Rejected</span>';
                } else {
                    $row[] = '<span class="badge bg-warning text-dark">Pending</span>';
                }

                $row[] = '<form method="POST" action="'.route('admin.users.approve', $user->id).'">
                                '.csrf_field().'
                                <button class="btn btn-sm btn-success"
                                    '.($user->is_approved === 'approved' ? 'disabled' : '').'>
                                    Approve
                                </button>
                            </form>';
                $row[] = '<form method="POST" action="'.route('admin.users.reject', $user->id).'">
                                '.csrf_field().'
                                <button class="btn btn-sm btn-danger"
                                    '.($user->is_approved === 'rejected' ? 'disabled' : '').'>
                                    Reject
                                </button>
                            </form>';
                $row[] = '<form method="POST" action="'.route('admin.users.makeAdmin', $user->id).'">
                                '.csrf_field().'
                                <button class="btn btn-sm btn-primary"
                                    '.($user->role === 'admin' ? 'disabled' : '').'
                                    onclick="return confirm(\'Jadikan user ini admin?\')">
                                    Make Admin
                                </button>
                            </form>';
                $data[] = $row;
            }

            return response()->json([
                "sql" => $dataUser,
                "draw" => -1,
                "recordsTotal" => count($data),
                "recordsFiltered" => count($data),
                "data" => $data
            ]);

        } catch (Exception $ex){
            return response()->json([
                'code' => $ex->getCode(),
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function searchUserData(Request $request)
    {
        try {
            $query = User::where('id', '!=', Auth::id());

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            if ($request->filled('status')) {
                $query->where('is_approved', $request->status);
            }

            if ($request->filled('role')) {
                $query->where('role', $request->role);
            }

            $users = $query->orderBy('created_at', 'desc')->get();

            $data = [];
            $no = 1;

            foreach ($users as $user) {
                $row = [];
                $row[] = $no++;
                $row[] = e($user->name);
                $row[] = e($user->email);
                $row[] = ucfirst($user->role);

                // STATUS
                if ($user->is_approved === 'approved') {
                    $row[] = '<span class="badge bg-success">Approved</span>';
                } elseif ($user->is_approved === 'rejected') {
                    $row[] = '<span class="badge bg-danger">Rejected</span>';
                } else {
                    $row[] = '<span class="badge bg-warning text-dark">Pending</span>';
                }

                // APPROVE
                $row[] = '<form method="POST" action="'.route('admin.users.approve',$user->id).'">
                            '.csrf_field().'
                            <button class="btn btn-success btn-sm"
                                '.($user->is_approved === 'approved' ? 'disabled' : '').'>
                                Approve
                            </button>
                        </form>';

                // REJECT
                $row[] = '<form method="POST" action="'.route('admin.users.reject',$user->id).'">
                            '.csrf_field().'
                            <button class="btn btn-danger btn-sm"
                                '.($user->is_approved === 'rejected' ? 'disabled' : '').'>
                                Reject
                            </button>
                        </form>';

                // MAKE ADMIN
                $row[] = '<form method="POST" action="'.route('admin.users.makeAdmin',$user->id).'">
                            '.csrf_field().'
                            <button class="btn btn-primary btn-sm"
                                '.($user->role === 'admin' ? 'disabled' : '').'>
                                Make Admin
                            </button>
                        </form>';

                $data[] = $row;
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $users->count(),
                "recordsFiltered" => $users->count(),
                "data" => $data
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }




    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_approved' => 'approved',]);

        return back()->with('success', 'User berhasil di-approve.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_approved' => 'rejected',]);

        return back()->with('success', 'User berhasil direject.');
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => 'admin',]);

        return back()->with('success', 'Role user berhasil diubah menjadi admin.');
    }

}
