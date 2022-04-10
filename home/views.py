""" Views - home. """

from django.shortcuts import render


def index(request):
    """ A view to go to the index page. """

    return render(request, 'home/index.html')


def privacy_policy(request):
    """ A view to go to the privacy policy page. """

    context = {
        'page': 'home',
    }

    return render(request, 'home/privacypolicy.html', context)
