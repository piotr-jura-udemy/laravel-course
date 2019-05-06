<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Comment;
use Illuminate\Support\Facades\Storage;

class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Commented was posted on your {$this->comment->commentable->title} blog post";
        return $this
            // First example with full path
            // ->attach(
            //     storage_path('app/public') . '/' . $this->comment->user->image->path,
            //     [
            //         'as' => 'profile_picture.jpeg',
            //         'mime' => 'image/jpeg'
            //     ]
            // )
            // ->attachFromStorage($this->comment->user->image->path, 'profile_picture.jpeg')
            // ->attachFromStorageDisk('public', $this->comment->user->image->path)
            // ->attachData(Storage::get($this->comment->user->image->path), 'profile_picture_from_data.jpeg', [
            //     'mime' => 'image/jpeg'
            // ])
            ->subject($subject)
            ->view('emails.posts.commented');
    }
}
