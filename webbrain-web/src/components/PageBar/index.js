import { useEffect, useState } from "react"
import { Pagination } from "react-bootstrap"

const PageBar = ({currentPage, lastPage, handlePageSelected}) => {
    const [paginationItens, setPaginationItens] = useState([])

    useEffect(() => {
        generatePaginationList()
    }, [currentPage, lastPage])

    function generatePaginationList() {
        let items = []

        if (lastPage > 1) {
            if (currentPage > 1) {
                items.push(
                    <Pagination.First 
                        onClick={() => handlePageSelected(1)} key={"firstPage"}
                    />
                    ,<Pagination.Prev 
                        onClick={() => handlePageSelected(currentPage - 1)}  
                        key={"prevPage"}
                    />
                )
            }

            items.push(
                generatePaginationItens(1)
            )

            if (currentPage >= 5) {
                items.push(
                    <Pagination.Ellipsis  key={"firstEllipsis"}/>
                )
            }

            getListPagesToDisplay(currentPage).filter(page => {
                return page > 1 && page < lastPage
            }).forEach(page => {
                items.push(
                    generatePaginationItens(page)
                )
            })

            if (currentPage < lastPage - 3) {
                items.push(
                    <Pagination.Ellipsis  key={"lastEllipsis"}/>
                )
            }

            items.push(
                generatePaginationItens(lastPage)
            )
      
            if (currentPage < lastPage) {
                items.push(
                    <Pagination.Next 
                        onClick={() => handlePageSelected(currentPage+1)} key={"nextPage"}
                    />
                    ,<Pagination.Last 
                        onClick={() => handlePageSelected(lastPage)}  
                        key={"lastPage"}
                    />
                )
            }
        } else {
            items.push(
                generatePaginationItens(1)
            )
        }
        
        setPaginationItens(
            items
        )
    }
    
    const  getListPagesToDisplay = (currentPage) => {
        return [
            currentPage - 2,
            currentPage - 1,
            currentPage,
            currentPage + 1,
            currentPage + 2
        ]
    }

    const generatePaginationItens = (page)  =>  {
        return (
            <Pagination.Item 
                onClick={() => handlePageSelected(page)}
                active={currentPage === page}
                key={page}
            >{page}</Pagination.Item>
        )
    }

    return (
        <Pagination className="align-items-center justify-content-center">
            {paginationItens}
        </Pagination>
    )
}

export default PageBar;