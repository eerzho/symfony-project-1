<?php

namespace App\Security\Voter;

use App\Entity\SecurityUser;
use App\Entity\Video;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class VideoVoter extends Voter
{
    public const EDIT = 'video_edit';
    public const VIEW = 'video_view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::VIEW])
            && $subject instanceof Video;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof SecurityUser) {
            return false;
        }

        return match ($attribute) {
            self::EDIT, self::VIEW => $this->canView($user, $subject),
            default => false,
        };
    }

    public function canView(SecurityUser $user, Video $video): bool
    {
        return $user->getId() == $video->getSecurityUser()->getId();
    }
}
