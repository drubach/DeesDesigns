***REMOVED*** Views - home. ***REMOVED***
from django.shortcuts import render

# Create your views here.

def index(request):
    ***REMOVED*** A view to return the index page. ***REMOVED***

    return render(request, 'home/index.html')
