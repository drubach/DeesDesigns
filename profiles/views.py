from django.shortcuts import render, get_object_or_404, redirect, reverse
from django.contrib import messages
from django.contrib.auth.decorators import login_required
from .models import UserProfile
from .forms import UserProfileForm, UserForm
from django.contrib.auth.models import User
from allauth.account.models import EmailAddress
from allauth.socialaccount.models import SocialAccount
from checkout.models import Order


@login_required
def profile(request):
    """ Display the user's profile. """
    profile = get_object_or_404(UserProfile, user=request.user)
    user = get_object_or_404(User, username=request.user)    

    if request.method == 'POST':
        form = UserProfileForm(request.POST, instance=profile)
        form_two = UserForm(request.POST, instance=user)
        if form.is_valid() and form_two.is_valid():
            form.save()
            form_two.save()
        else:
            messages.error(request, 'Update failed. Please ensure the form is valid.')
    else:
        form = UserProfileForm(instance=profile) 
    
    template = 'profiles/profile.html'
    context = {
        'page': 'profile',
        'profile': profile,
        'user': user,
        'on_profile_page': True,
    }

    return render(request, template, context)


@login_required
def edit_profile(request):
    """ Display the user's profile. """
    profile = get_object_or_404(UserProfile, user=request.user)
    user = get_object_or_404(User, username=request.user)

    form = UserProfileForm(instance=profile)
    form_two = UserForm(instance=user)

    messages.info(request, f'You are now editing your profile.')
    template = 'profiles/edit_profile.html'
    
    context = {
        'page': 'profile',
        'form': form,
        'form_two':form_two,
        'on_profile_page': True,
    }

    return render(request, template, context)


@login_required
def delete_profile(request):
    '''Delete user profile'''
    if request.method == "POST":
    
        user = get_object_or_404(User, username=request.user)
        user.delete()

        messages.success(request, 'You have successfully deleted your profile.')
        return redirect(reverse('home'))
    
    template = "profiles/delete_profile.html"

    context= {
        'page':'profile',
        'on_profile_page': True,
    }

    return render(request, template, context)
