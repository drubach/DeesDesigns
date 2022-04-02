***REMOVED*** Views - home. ***REMOVED***

from django.shortcuts import render


def index(request):
    ***REMOVED*** A view to go to the index page. ***REMOVED***

    return render(request, 'home/index.html')


def privacy_policy(request):
    ***REMOVED*** A view to go to the privacy policy page. ***REMOVED***

    context = {
        'page': 'home',
***REMOVED***

    return render(request, 'home/privacypolicy.html', context)
