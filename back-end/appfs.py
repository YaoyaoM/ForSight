from flask import Flask, request

app = Flask(__name__)

## A FUNCTION FOR EASIER STRING PARSING

def find_between( s, begin, cease ):
    try:
        start = s.index(begin) + len(begin)
        end = s.index( cease, start )
        return s[start:end]
    except ValueError: 
        return ""

@app.route('/')
def hello():
    return 'hello'


@app.route('/review', methods = ['POST'])
def css_review():
    body = request.form['message']
    separated = body.split('}')
    matrix = []
    for p in separated: 
        matrix.append([])

        fsize = int(find_between(p, 'font-size:', ';'))
        if fsize is None:
            matrix[p.index()].append('0')
        elif fsize<12:
            matrix[p.index()].append('12')
        elif fsize>12:
            matrix[p.index()].append('0')
        
        fweight = find_between(p, 'font-weight:', ';')
        if fweight is None:
            matrix[p.index()].append('0')
        elif fweight in ['normal','initial','inherit','lighter','100','200','300','400']:
            matrix[p.index()].append('500')
        
        color = find_between(p, 'color:', ';')
        if color is None:
            matrix[p.index()].append('0')
        elif color in ["red", "green", "#FFA07A", "#FA8072", "#E9967A", "#F08080", "#CD5C5C", "#FF6347", "#FF4500", "#DB7093", "#FF9999", "#FFCCCC", "#EEB4B4", "#CDB7B5", "#CD9B9B", "#E5FFCC", "#CCFFCC", "#CCFFCC", "#99FF99", "#CCFF99", "#B2FF66"]:
            matrix[p.index()].append('color error')
        elif not color in ["red", "green", "#FFA07A", "#FA8072", "#E9967A", "#F08080", "#CD5C5C", "#FF6347", "#FF4500", "#DB7093", "#FF9999", "#FFCCCC", "#EEB4B4", "#CDB7B5", "#CD9B9B", "#E5FFCC", "#CCFFCC", "#CCFFCC", "#99FF99", "#CCFF99", "#B2FF66"]:
            matrix[p.index()].append('0')

    return matrix
      
      
if __name__ == '__main__':
    app.run()
      






 
